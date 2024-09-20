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
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/reset.css"/>

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/SeatSelection.css"/>
    <title>Seat Selection</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
</head>

<body>

<div class="outer-box">
    <div class="top-box">
        <div class="img-box">
            <img draggable="false" src="<?php
            if (isset($data)) {
                echo ROOT . $data["movie"]["photo"];
            }
            ?>"/>
        </div>
        <div class="info-box">
            <div class="movie-details">
                <div class="movie-name">
                    <?php
                    if (isset($data)) {
                        echo $data["movie"]["title"];    //For std object
                    }
                    ?>
                </div>
                <div class="movie-duration" style="margin-top:5px;">
                    <i class="fa-regular fa-clock"></i>
                    <?php
                    if (isset($data["movie"]["duration"])) {
                        $duration = $data["movie"]["duration"];
                        $hour = intdiv($duration, 60);
                        $minute = $duration % 60;
                        echo $hour . " Hours " . $minute . " Mins";
                    }
                    ?>
                </div>
            </div>
            <div class="select-details">
                <div class="s-box">
                    <p class="s-title">
                        <i class="fa-solid fa-film"></i>&nbsp;Cinema
                    </p>
                    <p class="det">
                        <?php
                        if (isset($data)) {
                            echo $data["qs"]["cinema"];
                        }
                        ?>
                    </p>
                </div>
                <div class="s-box">
                    <p class="s-title">
                        <i class="fa-solid fa-film"></i>&nbsp;Experience
                    </p>
                    <p class="det">
                        <?php
                        if (isset($data)) {
                            echo $data["qs"]["experience"] . " (" . $data["qs"]["hallName"] . ")";
                        }
                        ?>
                    </p>
                </div>
                <div class="s-box">
                    <p class="s-title">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;Date & Time
                    </p>
                    <p class="det">
                        <?php
                        if (isset($data)) {
                            $date = new DateTime($data["qs"]["date"]);
                            $formattedDate = $date->format('D d F, h:i A');
                            echo $formattedDate;
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="middle-box">
        <div class="cancel-btn">
            <button onclick="history.back()" type="button" class="btn btn-danger"><i
                        class="fa-solid fa-angle-left"></i>&nbsp;Back
            </button>
        </div>

        <div class="inmiddle">

            <img src="<?= ROOT ?>/assets/images/screen.png" draggable="false"/>

            <div class="screen-tt">
                Screen
            </div>

        </div>
    </div>


    <div class="bottom-box seats" id="seats">
        <!--From JS-->
    </div>


    <div class="indicator-box">

        <div class="indicator-subbox">
            <div style="color:white;" class="indicator">
                No.
            </div>
            <div class="indicator-tt">
                Available
            </div>
        </div>

        <div class="indicator-subbox">
            <div style="background-color:#f03351; color:white;" class="indicator">
                No.
            </div>
            <div class="indicator-tt">
                Selected
            </div>
        </div>

        <div class="indicator-subbox">
            <div style="color:#f03351; background-color: white;" class="indicator">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="indicator-tt">
                Occupied
            </div>
        </div>

    </div>
</div>


<div style="width: 98%; margin-left: auto; margin-right: auto" id="alert-container"></div>
<form id="myForm" action="<?= ROOT ?>/SeatSelection/SubmitRequest" method="post">
    <div class="footer-box">
        <div class="left-b">
            <div class="lbtt">
                Seat Selection
            </div>
            <div id="listOfSeat" class="listOfSeat">
                <!--Show all seats selected by user-->
                -
            </div>
        </div>
        <div class="right-b">

            <div class="innerright">
                <div>
                    <button id="reset" type="button" class="btn btn-secondary">Reset</button>
                </div>
                <div>
                    <input id="submitPurchase" type="submit" class="btn btn-light" value="Confirm"/>
                </div>
            </div>
        </div>
    </div>
    <!--A set of values for controller-->
    <input type="hidden" name="scheduleId" id="scheduleId" value="<?php if (isset($data)) {
        echo $data["qs"]["movieScheduleId"];
    } ?>"/>
    <input type="hidden" name="listOfSeat" id="hiddenListOfSeat"/>

    <?php
    if (isset($data)) {
        foreach ($data["qs"] as $key => $value) {
            echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
        }
    }
    ?>

    <input type="hidden" name="destination" value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
</form>

<input type="hidden" id="capacity" value="<?= isset($data) ? $data["hall"][0]["capacity"] : '' ?>"/>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.querySelector('.bottom-box');

        // Generate seats based on capacity
        $(document).ready(function () {
            var capacity = document.getElementById("capacity").value.trim();
            var seatConfigurations = {
                "48": [
                    {label: 'A', seats: 12},
                    {label: 'B', seats: 12},
                    {label: 'C', seats: 12},
                    {label: 'D', seats: 12}
                ],
                "60": [
                    {label: 'A', seats: 12},
                    {label: 'B', seats: 12},
                    {label: 'C', seats: 12},
                    {label: 'D', seats: 12},
                    {label: 'E', seats: 12}
                ],
                "108": [
                    {label: 'A', seats: 12},
                    {label: 'B', seats: 12},
                    {label: 'C', seats: 12},
                    {label: 'D', seats: 12},
                    {label: 'E', seats: 12},
                    {label: 'F', seats: 12},
                    {label: 'G', seats: 12},
                    {label: 'H', seats: 12},
                    {label: 'I', seats: 12}
                ]
            };

            <?php
            // Assuming $data['occupiedSeat'] contains the array of seat numbers that are occupied (like 'A1', 'B2', etc.)
            $occupiedSeatNumbers = array_map(function ($seat) {
                return $seat['seatNo'];
            }, $data['occupiedSeat']);
            $occupiedSeatsJson = json_encode($occupiedSeatNumbers);
            ?>
            var occupiedSeats = <?php echo $occupiedSeatsJson; ?>;

            //alert(occupiedSeats)

            function generateSeats(rows) {
                $('#seats').empty();
                rows.forEach(row => {
                    var rowHtml = `<div class="row" data-row="${row.label}">`;
                    rowHtml += `<div class="seatrowtitle">${row.label}</div>`;

                    for (var j = 0; j < row.seats; j++) {
                        var seatNumber = row.label + (j + 1); // Generate seat number (e.g., A1, A2)

                        // Check if the seat number exists in the occupiedSeats array
                        if (occupiedSeats.includes(seatNumber)) {
                            rowHtml += `<div class="seat occupied"></div>`; // Occupied seats without number
                        } else {
                            rowHtml += `<div class="seat">${j + 1}</div>`; // Available seats with number
                        }
                    }

                    rowHtml += `</div>`;
                    $('#seats').append(rowHtml);
                });

                // Call to update seat numbers after generating seats
                updateSeatNumbers();
            }

            generateSeats(seatConfigurations[capacity]);
        });

        function updateSeatNumbers() {
            const rows = document.querySelectorAll('.row');
            rows.forEach((row) => {
                const seats = row.querySelectorAll('.seat');
                seats.forEach((seat, index) => {
                    if (!seat.classList.contains("occupied")) {
                        seat.innerText = index + 1;
                    } else {
                        const icon = document.createElement('i');
                        icon.className = 'fa-solid fa-user';
                        seat.appendChild(icon);
                    }
                });
            });
        }

        container.addEventListener('click', e => {
            if (e.target.classList.contains('seat') &&
                !e.target.classList.contains('occupied')) {
                e.target.classList.toggle('selected');
            }
            updateSelectedCount();
        });

        const resetBtn = document.querySelector("#reset");
        resetBtn.addEventListener('click', () => {
            document.querySelectorAll('.row .seat.selected').forEach(seat => {
                seat.classList.remove('selected');
            });
            updateSelectedCount();
        });

        function updateSelectedCount() {
            var seatArray = [];
            const seatResult = document.querySelector("#listOfSeat");
            const selectedSeats = document.querySelectorAll('.row .seat.selected');
            selectedSeats.forEach(seat => {
                const row = seat.closest('.row').getAttribute('data-row');
                seatArray.push(row + seat.innerHTML);
            });
            seatResult.innerHTML = seatArray.join(', ');

            //Add value to hidden field
            const hiddenListOfSeat = document.querySelector("#hiddenListOfSeat");
            hiddenListOfSeat.value = seatArray.join('|');
        }
    });


    document.getElementById('myForm').addEventListener('submit', function (event) {
        //Get form elements
        const seats = document.getElementById('hiddenListOfSeat').value;

        //Validation flags
        var isValid = true;

        //Validate the user has selected at least one seat
        if (!seats) {
            event.preventDefault()
            createAlert('Please select at least one seat to proceed.', 'danger');
        }
    });


    function createAlert(message, alertType) {
        // Create the alert element
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${alertType} alert-dismissible fade show`;
        alertDiv.role = 'alert';

        // Create the strong element for the message
        const strong = document.createElement('strong');
        strong.textContent = message;

        // Create the button element to close the alert
        const closeButton = document.createElement('button');
        closeButton.type = 'button';
        closeButton.className = 'btn-close';
        closeButton.setAttribute('data-bs-dismiss', 'alert');
        closeButton.setAttribute('aria-label', 'Close');

        // Append the strong element and close button to the alert
        alertDiv.appendChild(strong);
        alertDiv.appendChild(closeButton);

        // Insert the alert into the container
        document.getElementById('alert-container').appendChild(alertDiv);
    }

</script>

</body>

</html>