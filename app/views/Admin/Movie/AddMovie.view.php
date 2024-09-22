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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <a href="<?= ROOT ?>/MovieManagement">
                <button class="btn btn-outline-primary mb-3">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </button>
            </a>
            <h1 class="mb-4"><i class="fas fa-film me-2"></i>Add New Movie</h1>

            <form id="addMovieForm" class="main-content p-4 mt-3"
                  style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);"
                  enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label"><i class="fas fa-heading me-2"></i>Title</label>
                    <input type="text" class="form-control" id="title" name="title" required/>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label"><i class="fas fa-image me-2"></i>Movie Poster</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required
                           onchange="previewImage(this);"/>
                    <img id="photoPreview" src="" alt="Photo preview"
                         style="display:none; max-width: 200px; max-height: 300px; margin-top: 10px;">
                </div>

                <div class="mb-3">
                    <label for="duration" class="form-label"><i class="fas fa-clock me-2"></i>Duration (minutes)</label>
                    <input type="number" class="form-control" id="duration" name="duration" min="1" required/>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label"><i class="fas fa-tags me-2"></i>Category</label>
                    <input type="text" class="form-control" id="catagory" name="catagory" required/>
                    <small class="form-text text-muted">Separate multiple categories with commas</small>
                </div>

                <div class="mb-3">
                    <label for="classification" class="form-label"><i class="fas fa-certificate me-2"></i>Classification</label>
                    <select class="form-select" id="classification" name="classification" required>
                        <option value="">Select classification</option>
                        <option value="G">G - General</option>
                        <option value="PG">PG - Parental Guidance</option>
                        <option value="PG-13">PG-13</option>
                        <option value="R">R - Restricted</option>
                        <option value="NC-17">NC-17</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label"><i class="fas fa-toggle-on me-2"></i>Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="">Select status</option>
                        <option value="Now Showing">Now Showing</option>
                        <option value="Coming Soon">Coming Soon</option>
                        <option value="Not Showing">Not Showing</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="releaseDate" class="form-label"><i class="fas fa-calendar-alt me-2"></i>Release
                        Date</label>
                    <input type="date" class="form-control" id="releaseDate" name="releaseDate" required/>
                </div>

                <div class="mb-3">
                    <label for="language" class="form-label"><i class="fas fa-language me-2"></i>Language</label>
                    <input type="text" class="form-control" id="language" name="language" required/>
                </div>

                <div class="mb-3">
                    <label for="subtitles" class="form-label"><i
                                class="fas fa-closed-captioning me-2"></i>Subtitles</label>
                    <input type="text" class="form-control" id="subtitles" name="subtitles"/>
                    <small class="form-text text-muted">Separate multiple languages with commas</small>
                </div>

                <div class="mb-3">
                    <label for="director" class="form-label"><i class="fas fa-user-tie me-2"></i>Director</label>
                    <input type="text" class="form-control" id="director" name="director" required/>
                </div>

                <div class="mb-3">
                    <label for="casts" class="form-label"><i class="fas fa-users me-2"></i>Cast</label>
                    <textarea class="form-control" id="casts" name="casts" rows="3" required></textarea>
                    <small class="form-text text-muted">Enter each cast member on a new line</small>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label"><i
                                class="fas fa-align-left me-2"></i>Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Add Movie
                </button>
            </form>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addMovieForm = document.getElementById('addMovieForm');

        addMovieForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('<?=ROOT?>/MovieManagement/addMovie', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Movie added successfully!");
                        window.location.href = "<?=ROOT?>/MovieManagement";
                    } else {
                        alert('Error: ' + data.message);
                        console.error('Detailed error:', data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while adding the movie.');
                });
        });
    });

    function previewImage(input) {
        const preview = document.getElementById('photoPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "";
            preview.style.display = 'none';
        }
    }
</script>
</body>
</html>