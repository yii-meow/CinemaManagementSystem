<!--
Author: Chong Kah Yan
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/reset.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Main.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.css" />
    <title>Categories</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
</head>

<body>

<body>
<div id="Customer">

    <?php include '../app/views/header.php' ?>


    <?php include '../app/views/navigationBar.php' ?>


    <!--Main Contents-->

    <div class="outer-box">
        <div class="main-title">
            User Profile
        </div>
        <!-- Left Sidebar -->
        <div class="left-box">
            <div class="profile-card">
                <img src="<?= ROOT ?>/assets/images/profile1.jpg" alt="Profile Picture" class="user-image">
                <p class="user-name">Kyan</p>
                <button class="edit-profile-btn" onclick="window.location.href='ProfileEdit'">Edit
                    Profile</button>
                <div class="reward-info">
                    <div class="reward-item-info">
                        <p>Coins</p>
                        <p>0</p>
                    </div>
                    <div class="reward-item-info">
                        <p>My Rewards</p>
                        <p>0</p>
                    </div>
                </div>
            </div>

            <div class="nav-menu">
                <a href="#">My Tickets</a>
                <a href="MyReward">My Rewards</a>
                <a href="RewardCentre">Rewards Centre</a>
                <a href="#">Favourite</a>
                <a href="ChangePass">Change Password</a>
                <a href="#">Delete Account</a>
            </div>
        </div>

        <!-- Right Content -->
        <div class="right-box">
            <h2>Favourite</h2>

            <!-- Filter Controls -->
            <div class="filter-controls">
                <label for="filter-title">Search:</label>
                <input type="text" id="filter-title" oninput="filterMovies()">

                <label for="sort-by">Sort by:</label>
                <select id="sort-by" onchange="sortMovies()">
                    <option value="title">Title</option>
                    <option value="release-date">Release Date</option>
                    <option value="genre">Genre</option>
                </select>
            </div>

            <!-- Delete Selected Button -->
            <button class="delete-selected-btn" onclick="deleteSelectedMovies()">Delete Selected</button>

            <!-- Favourite Movies List -->
            <div class="favourite-movies-list">
                <!-- Movie Item -->
                <div class="favourite-movie-item" data-title="Movie Title 1" data-genre="Action"
                     data-release-date="2022">
                    <input type="checkbox" class="movie-checkbox">
                    <div class="movie-details">
                        <h3>Movie Title 1</h3>
                        <p>Genre: Action</p>
                        <p>Release Date: 2022</p>
                    </div>
                </div>
                <div class="favourite-movie-item" data-title="Movie Title 2" data-genre="Drama"
                     data-release-date="2020">
                    <input type="checkbox" class="movie-checkbox">
                    <div class="movie-details">
                        <h3>Movie Title 2</h3>
                        <p>Genre: Drama</p>
                        <p>Release Date: 2020</p>
                    </div>
                </div>
                <!-- Add more favourite movie items as needed -->
            </div>
        </div>
    </div>

    <!--End of Main Contents-->


    <?php include '../app/views/footer.php' ?>



    <!--JavaScripts-->
    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>