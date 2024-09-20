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
                <a href="<?= ROOT ?>/AddMovie" class="w-25">
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
                <?php if (isset($movies)) foreach ($movies as $movie): ?>
                    <div class="col">
                        <div class="card movie-card">
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
                                    <button type="button" class="btn btn-outline-primary edit-movie"
                                            data-movie-id="<?php echo $movie->getMovieId(); ?>">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-outline-danger remove-movie"
                                            data-movie-id="<?php echo $movie->getMovieId(); ?>">
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
                    console.log(data);
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
                    console.error('Error:', error);
                    alert('An error occurred while exporting the movies: ' + error.message);
                });
        });
    });
</script>
</body>
</html>
