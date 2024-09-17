<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Feedback.css" />
    <title>Feedback</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
</head>

<body>

<div id="Customer">
    <?php include(dirname(__DIR__) . '../../header.php') ?>
    <?php include(dirname(__DIR__) . '../../navigationBar.php') ?>


    <!--Main Contents-->
    <div class="main-content">

        <div class="centered-container">
            <div class="MyPostTitle">
                Feedback
            </div>
            <br><br><br>
            <div class="inner-container">

                <form id="createFeedbackForm" enctype="multipart/form-data" method="post" action="FeedbackController/submit">
                    <div class="mb-3">
                        <label for="feedback" class="form-label">My feedback</label>
                        <textarea class="form-control" id="feedback" rows="4"
                                  placeholder="Tell us what you think..." name="content" required></textarea>
                    </div>

                    <!--Rating-->
                    <div class="rating">
                        <label>
                            <input type="radio" name="stars" value="1" required/>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="stars" value="2" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="stars" value="3" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="stars" value="4" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="stars" value="5" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                    </div>

                    <div class="space-btw">

                        <div>
                            <a href="FeedbackHistory" class="hover-red">
                                <p>Check on feedback history</p>
                            </a>
                        </div>
                        <div><button type="submit" class="btn btn-primary">Submit</button></div>
                    </div>
                </form>

            </div>


        </div>
    </div>


    <!--End of Main Contents-->



    <!--Footer-->
    <footer id="footer">
        <div class="footer-container container-fluid">
            <div class="bottom" style="text-align: center; color: white;">
                © 2023 - 2024 DreamWorks Cinema (Copyright All Right Reserved)
            </div>
        </div>
    </footer>




    <!--JavaScripts-->
    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">


    </script>
</body>

</html>
