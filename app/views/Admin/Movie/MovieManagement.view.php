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
    <title>Cinema Management</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png"/>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include(dirname(__DIR__) . '../../adminSidebar.php') ?>

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
            <div class="mb-4 d-flex flex-row-reverse">
                <a href="<?= ROOT ?>/MovieManagement/addPage" class="w-25">
                    <button class="btn btn-primary px-4 py-2 w-100">
                        <i class="fa fa-plus me-3"></i>Add New Movie
                    </button>
                </a>
            </div>
            <div class="mb-5 d-flex flex-row-reverse">
                <button id="exportMovieXmlButton" class="btn btn-success px-4 py-2 w-25">
                    <i class="fa fa-download me-3"></i>
                    Export Movie Data to XML
                </button>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <?php if (isset($movies)) foreach ($movies as $movie): ?>
                    <div class="col">
                        <div class="card movie-card" data-movie-id="<?php echo $movie->getMovieId(); ?>"
                             data-release-date="<?php echo $movie->getReleaseDate()->format('Y-m-d'); ?>"
                             data-language="<?php echo htmlspecialchars($movie->getLanguage()); ?>"
                             data-subtitles="<?php echo htmlspecialchars($movie->getSubtitles()); ?>"
                             data-casts="<?php echo htmlspecialchars($movie->getCasts()); ?>"
                             data-description="<?php echo htmlspecialchars($movie->getDescription()); ?>"
                             data-trailer-link="<?php echo htmlspecialchars($movie->getTrailerLink()); ?>"
                             data-status="<?php echo htmlspecialchars($movie->getStatus()); ?>">
                            <img
                                    src="<?php echo htmlspecialchars(ROOT . $movie->getPhoto()); ?>"
                                    class="card-img-top"
                                    alt="<?php echo htmlspecialchars($movie->getTitle()); ?>"
                            />
                            <div class="card-body">
                                <h5 class="movie-card-title"><?php echo htmlspecialchars($movie->getTitle()); ?></h5>
                                <p class="card-text text-secondary">
                                    Category: <?php echo htmlspecialchars($movie->getCatagory()); ?>
                                </p>
                                <p class="card-text text-secondary mt-4">
                                    Director: <?php echo htmlspecialchars($movie->getDirector()); ?>
                                </p>
                                <p class="card-text text-secondary">Duration: <?php echo $movie->getDuration(); ?>
                                    mins</p>
                                <p class="card-text text-secondary">
                                    Classification: <?php echo htmlspecialchars($movie->getClassification()); ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary edit-movie">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-outline-danger remove-movie">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</div>

<div class="modal fade" id="editMovieModal" tabindex="-1" aria-labelledby="editMovieModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMovieModalLabel">Edit Movie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMovieForm">
                    <input type="hidden" id="editMovieId" name="movieId">
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCategory" class="form-label">Category</label>
                        <input type="text" class="form-control" id="editCategory" name="catagory" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDirector" class="form-label">Director</label>
                        <input type="text" class="form-control" id="editDirector" name="director" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDuration" class="form-label">Duration (minutes)</label>
                        <input type="number" class="form-control" id="editDuration" name="duration" required>
                    </div>
                    <div class="mb-3">
                        <label for="editClassification" class="form-label">Classification</label>
                        <input type="text" class="form-control" id="editClassification" name="classification" required>
                    </div>
                    <div class="mb-3">
                        <label for="editReleaseDate" class="form-label">Release Date</label>
                        <input type="date" class="form-control" id="editReleaseDate" name="releaseDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="editLanguage" class="form-label">Language</label>
                        <input type="text" class="form-control" id="editLanguage" name="language" required>
                    </div>
                    <div class="mb-3">
                        <label for="editSubtitles" class="form-label">Subtitles</label>
                        <input type="text" class="form-control" id="editSubtitles" name="subtitles">
                    </div>
                    <div class="mb-3">
                        <label for="editCasts" class="form-label">Casts</label>
                        <input type="text" class="form-control" id="editCasts" name="casts" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="3"
                                  required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveMovieChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('exportMovieXmlButton').addEventListener('click', function () {
            fetch('<?=ROOT?>/MovieManagement/exportMovieToXML', {
                method: 'GET',
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        throw new Error(data.error);
                    } else {
                        if (confirm("Are you sure to download exported XML for movie data ?")) {
                            // Download the HTML file
                            const htmlBlob = new Blob([atob(data.html)], {type: 'text/html'});
                            const htmlUrl = window.URL.createObjectURL(htmlBlob);
                            const htmlLink = document.createElement('a');
                            htmlLink.href = htmlUrl;
                            htmlLink.download = 'movies_summary.html';
                            htmlLink.click();
                            window.URL.revokeObjectURL(htmlUrl);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error.message);
                    // alert('An error occurred while exporting the movies: ' + error.message);
                });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editMovieModal = new bootstrap.Modal(document.getElementById('editMovieModal'));
        const editMovieForm = document.getElementById('editMovieForm');
        const saveMovieChangesButton = document.getElementById('saveMovieChanges');

        // Use event delegation for edit buttons
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('edit-movie') || event.target.closest('.edit-movie')) {
                const button = event.target.classList.contains('edit-movie') ? event.target : event.target.closest('.edit-movie');
                const movieCard = button.closest('.movie-card');
                populateModalAndOpen(movieCard);
            } else if (event.target.classList.contains('remove-movie') || event.target.closest('.remove-movie')) {
                const button = event.target.classList.contains('remove-movie') ? event.target : event.target.closest('.remove-movie');
                const movieCard = button.closest('.movie-card');
                const movieId = movieCard.dataset.movieId;
                const movieTitle = movieCard.querySelector('.movie-card-title').textContent.trim();
                confirmAndRemoveMovie(movieId, movieTitle);
            }
        });

        function populateModalAndOpen(movieCard) {
            document.getElementById('editMovieId').value = movieCard.dataset.movieId;
            document.getElementById('editTitle').value = movieCard.querySelector('.movie-card-title').textContent.trim();
            document.getElementById('editCategory').value = movieCard.querySelector('.card-text:nth-child(2)').textContent.replace('Category:', '').trim();
            document.getElementById('editDirector').value = movieCard.querySelector('.card-text:nth-child(3)').textContent.replace('Director:', '').trim();
            document.getElementById('editClassification').value = movieCard.querySelector('.card-text:nth-child(5)').textContent.replace('Classification:', '').trim();
            document.getElementById('editDuration').value = movieCard.querySelector('.card-text:nth-child(4)').textContent.replace('Duration:', '').replace('mins', '').trim();

            // For hidden fields
            document.getElementById('editReleaseDate').value = movieCard.dataset.releaseDate || '';
            document.getElementById('editLanguage').value = movieCard.dataset.language || '';
            document.getElementById('editSubtitles').value = movieCard.dataset.subtitles || '';
            document.getElementById('editCasts').value = movieCard.dataset.casts || '';
            document.getElementById('editDescription').value = movieCard.dataset.description || '';

            editMovieModal.show();
        }

        saveMovieChangesButton.addEventListener('click', function () {
            const formData = new FormData(editMovieForm);
            const movieData = Object.fromEntries(formData.entries());

            fetch('<?=ROOT?>/MovieManagement/editMovie', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(movieData),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        editMovieModal.hide();
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the movie.');
                });
        });

        function confirmAndRemoveMovie(movieId, movieTitle) {
            if (confirm(`Are you sure you want to remove the movie "${movieTitle}"?`)) {
                fetch(`<?=ROOT?>/MovieManagement/removeMovie`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({movieId: movieId})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload()
                        } else {
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        alert('An error occurred while removing the movie.');
                    });
            }
        }
    });
</script>
</body>
</html>
