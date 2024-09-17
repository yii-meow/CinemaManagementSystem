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
            <h1 class="mb-2">Add New Movie</h1>

            <form
                    class="main-content p-4 mt-3"
                    style="
              background-color: #ffffff;
              border-radius: 8px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            "
            >
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" required/>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Movie Poster</label>
                    <input
                            type="file"
                            class="form-control"
                            id="photo"
                            accept="image/*"
                            required
                    />
                </div>

                <div class="mb-3">
                    <label for="trailerLink" class="form-label">Trailer Link</label>
                    <input
                            type="url"
                            class="form-control"
                            id="trailerLink"
                            required
                    />
                </div>

                <div class="mb-3">
                    <label for="duration" class="form-label"
                    >Duration (minutes)*</label
                    >
                    <input
                            type="number"
                            class="form-control"
                            id="duration"
                            min="1"
                            required
                    />
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" required/>
                    <small class="form-text text-muted"
                    >Separate multiple categories with commas</small
                    >
                </div>

                <div class="mb-3">
                    <label for="classification" class="form-label"
                    >Classification</label
                    >
                    <select class="form-select" id="classification" required>
                        <option value="">Select classification</option>
                        <option value="G">G - General</option>
                        <option value="PG">PG - Parental Guidance</option>
                        <option value="PG-13">PG-13</option>
                        <option value="R">R - Restricted</option>
                        <option value="NC-17">NC-17</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="releaseDate" class="form-label">Release Date</label>
                    <input
                            type="date"
                            class="form-control"
                            id="releaseDate"
                            required
                    />
                </div>

                <div class="mb-3">
                    <label for="language" class="form-label">Language</label>
                    <input type="text" class="form-control" id="language" required/>
                </div>

                <div class="mb-3">
                    <label for="subtitles" class="form-label">Subtitles</label>
                    <input type="text" class="form-control" id="subtitles"/>
                    <small class="form-text text-muted"
                    >Separate multiple languages with commas</small
                    >
                </div>

                <div class="mb-3">
                    <label for="director" class="form-label">Director</label>
                    <input type="text" class="form-control" id="director" required/>
                </div>

                <div class="mb-3">
                    <label for="casts" class="form-label">Cast</label>
                    <textarea
                            class="form-control"
                            id="casts"
                            rows="3"
                            required
                    ></textarea>
                    <small class="form-text text-muted"
                    >Enter each cast member on a new line</small
                    >
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                            class="form-control"
                            id="description"
                            rows="5"
                            required
                    ></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Add Movie</button>
            </form>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
