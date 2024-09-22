<?php
/**
 * @Chew Zi An
 */
?>
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
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
    <link rel="stylesheet" href="../../../../public/css/reset.css"/>

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Main.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PurchaseHistory.css"/>
    <title>Purchase History</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
</head>

<body>

<body>
<div id="Customer">

    <!--Header-->
    <?php include "../app/views/header.php" ?>

    <!--Navigation Bar-->
    <?php include "../app/views/navigationBar.php" ?>


    <!--Main Contents-->
    <div class="outer-box">
        <div class="main-title">
            Ticket Purchase
        </div>
        <div class="boxes">
            <div class="left-box" id="left-box">
                <div class="left-tt">
                    Ticket Status
                </div>
                <div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">

                    <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1" autocomplete="off"
                           checked>
                    <label class="btn btn-outline-danger btnRadio" for="vbtn-radio1">All</label>


                    <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2" autocomplete="off">
                    <label class="btn btn-outline-danger btnRadio" for="vbtn-radio2">Upcoming</label>


                    <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3" autocomplete="off">
                    <label class="btn btn-outline-danger btnRadio" for="vbtn-radio3">Past</label>

                </div>
            </div>

            <div class="right-box">
                <div class="main-box">


                    <?php if ($ticketCount > 0): ?>
                        <!-- An Item -->
                        <?php foreach ($records as $record): ?>
                            <div class="item" data-status="<?= htmlspecialchars(strtolower($record['ticketStatus'])) ?>">
                                <div class="left-info">
                                    <div class="l-info">
                                        <div class="m-name">
                                            <?= htmlspecialchars($record['movieTitle']) ?>
                                        </div>
                                        <div class="select-details">
                                            <div class="s-box">
                                                <p class="s-title">BOOKING ID</p>
                                                <p class="det">: <?= htmlspecialchars($record['ticketId']) ?></p>
                                            </div>
                                            <div class="s-box">
                                                <p class="s-title">CINEMA</p>
                                                <p class="det">: <?= htmlspecialchars($record['hallName']) ?></p>
                                            </div>
                                            <div class="s-box">
                                                <p class="s-title">EXPERIENCE</p>
                                                <p class="det">: <?= htmlspecialchars($record['hallType']) ?></p>
                                            </div>
                                            <div class="s-box">
                                                <p class="s-title">DATE & TIME</p>
                                                <p class="det">
                                                    : <?= htmlspecialchars($record['startingTime']->format('D d M, h:i A')) ?></p>
                                            </div>
                                            <div class="s-box">
                                                <p class="s-title">STATUS</p>
                                                <p class="det">: <?= htmlspecialchars($record['ticketStatus']) ?></p>
                                            </div>
                                            <div class="s-box">
                                                <p class="s-title">TOTAL PRICE</p>
                                                <p class="det">: RM <?= number_format($record['totalPrice'], 2) ?></p>
                                            </div>
                                        </div>
                                        <div class="btm-info">
                                            <div class="btm-cont">
                                                <div class="btm-tt">Hall</div>
                                                <div class="btm-cont-dt"><?= htmlspecialchars($record['hallName']) ?></div>
                                            </div>
                                            <div class="bdr"></div>
                                            <div class="btm-cont">
                                                <div style="text-align: left !important;" class="btm-tt">Seats</div>
                                                <div style="text-align: left !important;" class="btm-cont-dt">
                                                    <?= htmlspecialchars($record['seatNo']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="right-info">
                                    <div class="qrcode">
                                        <img style="width: 250px; height: 250px;" src="<?php
                                            echo $record["qrCodeURL"];
                                        ?>"
                                             alt="QR Code"/>
                                    </div>
                                </div>
                            </div>
                            <!--An Item-->
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            No tickets found. Please check back later.
                        </div>
                    <?php endif; ?>
                    <!--End of An Item-->

                </div>
            </div>
        </div>
    </div>


    <!--End of Main Contents-->


    <!--Footer-->
    <?php include "../app/views/footer.php" ?>


    <!--JavaScripts-->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const radioButtons = document.querySelectorAll('input[name="vbtn-radio"]');
            const items = document.querySelectorAll('.item');

            radioButtons.forEach(button => {
                button.addEventListener('change', () => {
                    const selectedValue = document.querySelector('input[name="vbtn-radio"]:checked').nextElementSibling.textContent.toLowerCase();

                    items.forEach(item => {
                        const itemStatus = item.getAttribute('data-status');
                        if (selectedValue === 'all' || itemStatus === selectedValue) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });

            // Trigger change event on page load to apply the initial filter
            document.querySelector('input[name="vbtn-radio"]:checked').dispatchEvent(new Event('change'));
        });
    </script>

    <script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>