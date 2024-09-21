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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/FeedbackHistory.css" />
    <title>My Feedback</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
</head>

<body>

<body>
<div id="Customer">

    <?php include(dirname(__DIR__) . '../../header.php') ?>
    <?php include(dirname(__DIR__) . '../../navigationBar.php') ?>


    <!--Main Contents-->
    <div class="main-content">

        <div class="centered-container">
            <div class="MyPostTitle">
                My Feedback
            </div>
            <br>
            <div class="link" style="text-align: right">
                <a href="FeedbackController" style="color: white">Back to Add Feedback</a>
            </div>

            <?php if (!empty($data)){
                foreach ($data as $feedback){
                ?>
            <div class="inner-container mt-20">
                <div class="space-btw">
                    <div>
                        <?php for ($i = 1; $i <= 5; $i++){?>
                        <span class="fa fa-star  <?php if($feedback->getRating() >= $i) { echo "checked"; } ?>"></span>
                        <?php } ?>
                    </div>

                    <div><?= $feedback->getCreatedAt()->format('Y-m-d') ?></div>
                </div>

                <div class="content mt-20 text-align-center fs-large">
                    <?= $feedback->getContent() ?>
                </div>

                <?php if($feedback->getReply() || $feedback->getCoinCompensation()){ ?>
                <div class="feedback-reply mt-20 pd-20 text-align-justify bdr-5">
                        <?php if($feedback->getReply()){ ?>
                    <div>
                        <p>
                            Reply:
                        </p>
                        <br>
                        <p>
                            <?= $feedback->getReply() ?>
                        </p>
                    </div>
                    <?php } ?>

                        <?php if($feedback->getCoinCompensation()){ ?>
                    <div class="compensation mt-20 display-block text-align-center">
                        You have received <b><?= $feedback->getCoinCompensation() ?> Coins </b> as compensation.
                    </div>
                            <?php } ?>
                </div>
                <?php }else{ ?>
                    <div class="feedback-reply mt-20 pd-20 text-align-justify bdr-5">
                        <div class="compensation mt-20 display-block text-align-center">
                            <b>Your feedback is <?= $feedback->getStatus() ?></b>
                        </div>
                    </div>
                <?php } ?>


            </div>
            <?php }}else{?>
            <div class="inner-container mt-20" style="text-align: center;">
                We value your opinion! Please share your feedback with us <a href="FeedbackController">here</a>.
            </div>
            <?php } ?>




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
