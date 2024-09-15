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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/reset.css"/>

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Main.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/DetailSelection.css"/>
    <title>Movie Detail Selection</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png">
</head>


<body>
<!--Header-->
<?php include "../app/views/header.php"?>

<!--Navigation Bar-->
<?php include "../app/views/navigationBar.php"?>


<!--Main Contents-->

<div class="outer-box">
    <button onclick="history.back()" style="margin: 20px 20px;" type="button"
            class="btn btn-danger"><i class="fa-solid fa-angle-left"></i>&nbsp;Back
    </button>
    <div class="top-box">
        <div class="poster-box">
            <img src="
            <?php if (isset($data)) {
                echo $data['movies']['photo'];
            } ?>" style="width: 60%;" draggable="false"/>
        </div>
        <div class="detail-box">
            <div class="movie-name">
                <?php if (isset($data)) {
                    echo $data['movies']['title'];
                } ?>
            </div>
            <div class="movie-duration">
                <i class="fa-regular fa-clock"></i>&nbsp;
                <?php
                if (isset($data)) {
                    $duration = $data['movies']['duration'];
                    $hour = intdiv($duration, 60);
                    $minute = $duration % 60;
                    echo $hour . " Hours " . $minute . " Mins";
                }
                ?>
            </div>
            <a href="#middle-box"><i
                        style="width:fit-content; cursor: pointer; font-size: 40px; color:#f03351; margin: 5px 0px;"
                        class="fa-solid fa-caret-down"></i></a>
        </div>
    </div>

    <div class="middle-box" id="middle-box">
        <div class="select-date">
            <p class="date-title">Select Date</p>

            <form method="POST" id="form1">
                <div class="date-radio">

                    <?php if (isset($data)): ?>
                        <?php foreach ($data["schedules"] as $schedule): ?>
                            <?php
                            // Separate Date and Time
                            $startingTime = $schedule["startingTime"];

                            // Convert the DateTime object to the desired timezone
                            $startingTime->setTimezone(new \DateTimeZone('Asia/Kuala_Lumpur'));

                            $date = $startingTime->format('Y-m-d');
                            $time = $startingTime->format('H:i:s');

                            // Separate Year, Month, and Day
                            $dateResult = explode("-", $date); // Use this to break down the date parts
                            $year = $dateResult[0];
                            $month = $dateResult[1];
                            $day = $dateResult[2];

                            // Calculate Day of the Week
                            $dayOfWeek = date("D", strtotime($date)); // Format full day name (e.g., "Monday")
                            $monthName = date("M", strtotime($date)); // Short month name (e.g., "Jan")
                            ?>

                            <input type="radio" class="btn-check" name="selectedDate"
                                   value="<?php echo htmlspecialchars($startingTime->format('Y-m-d H:i:s')); ?>"
                                   id="<?php echo htmlspecialchars($schedule["movieScheduleId"]) ?>" autocomplete="off">
                            <label class="btn btn-outline-danger" for="<?php echo htmlspecialchars($schedule["movieScheduleId"]); ?>">
                                <p name="day"><?php echo $dayOfWeek; ?></p>
                                <p name="date"><?php echo $day; ?></p>
                                <p name="month"><?php echo $monthName; ?></p>
                            </label>

                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </form>
        </div>


        <div class="select-experience">
            <p class="experience-title">Select Experience</p>
            <form method="POST" id="form2">
                <div class="exp-radio" id="form_output">
                    <!--Result from AJAX-->
                    <p id="pretext">Please select a date.</p>
                </div>
            </form>
        </div>
    </div>


    <div class="bottom-box">
        <p class="cinema-title">Select Cinema and Time</p>


        <div class="accordion-box" id="accordion-box">
            <div class="accordion" id="accordion-container">
                <!--Content is generated in AJAX-->
                <p id="pretext">Please select Date or Experience first.</p>
            </div>
        </div>


    </div>

</div>


<!--Modal Content-->
<div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-image" style="text-align: center;">
                    <img src="<?php if (isset($data)) {
                        echo $data['movies']['photo'];
                    } ?>" style="width:30%;" draggable="false"/>
                    <div
                            style="color:white; font-size: 18px; font-weight: 600; margin-top: 15px; margin-bottom:8px;">
                        <?php if (isset($data)) {
                            echo $data['movies']['title'];
                        } ?>
                    </div>
                    <div style="color:#f03351">
                        <i class="fa-regular fa-clock"></i>
                        <?php
                        if (isset($data)) {
                            $duration = $data['movies']['duration'];
                            $hour = intdiv($duration, 60);
                            $minute = $duration % 60;
                            echo $hour . " Hours " . $minute . " Mins";
                        }
                        ?>
                    </div>
                </div>
                <div class="selected-detail">
                    <table class="selected-det">

                        <tr class="cinema">
                            <td class="title">Cinema :
                            </td>
                            <td class="answer t-cinema">
                                <span id="cinemaResult"></span>
                            </td>
                        </tr>

                        <tr class="experience">
                            <td class="title">Experience :
                            </td>
                            <td class="answer t-exp">
                                <span id="experienceResult"></span>
                            </td>
                        </tr>

                        <tr class="dateTime">
                            <td class="title">Time & Date :
                            </td>
                            <td class="answer t-timedate">
                                <span id="dateTimeResult"></span>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="modal-footer" style="display: flex; justify-content: center;">
                <button onclick="selectSeat()" style="width: 85%;" type="button"
                        class="btn btn-danger"><i class="fa-solid fa-couch"></i>&nbsp;Select
                    Seats
                </button>
            </div>
        </div>
    </div>
</div>


<!--Next Select Seat-->
<!--<div class="toTop" id="toTop">-->
<!--    <button id="top" onclick="showModal()" data-bs-target="#myModal">-->
<!--        <i class="fa-regular fa-circle-check"></i>&nbsp;Confirm-->
<!--    </button>-->
<!--</div>-->


<!--End of Main Contents-->


<!--Footer-->
<?php include "../app/views/footer.php"?>


<!--JavaScripts-->
<script src="https://kit.fontawesome.com/06c32b9e65.js" crossorigin="anonymous"></script>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>


<!--User Selection-->
<script>
    $.ajaxSetup({
        cache: false
    });

    // Unbind any previous event handlers before attaching new ones
    $('#form1').off('change', 'input[name="selectedDate"]').on('change', 'input[name="selectedDate"]', fetchHallTypes);
    $('#form2').off('change', 'input[name="options-exp"]').on('change', 'input[name="options-exp"]', fetchCinema);




    function fetchHallTypes() {
        var selectedDateTime = $("input[name='selectedDate']:checked").val();

        //Reset the experience choice
        $(".exp-radio").html('<p id="pretext">Loading experiences...</p>'); // Show loading message
        $("input[name='options-exp']").prop('checked', false);


        //Reset the cinema choice
        $("#accordion-container").html('<p id="pretext">Please select Date or Experience first.</p>'); // Show loading message
        $("input[name='time']").prop('checked', false);


        if (selectedDateTime) {
            $.ajax({
                url: "<?=ROOT?>/DetailSelection/fetchHallExperienceOfTheMovieDate",
                type: "POST",
                data: $('#form1').serialize(),
                success: function (response) {
                    var data = response.data;


                    //////Testing
                    //document.writeln(data)
                    //document.writeln(response)
                    document.writeln(JSON.stringify(response.data));


                    var innerHtml = '';

                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach(function (item, index) {
                            var id = 'exp' + (index + 1);
                            var hallType = item.hallType || 'Unknown';

                            //var selectedDate = selectedDateTime.split(" ")[0];
                            var valueToPass = hallType + "|" + selectedDateTime;

                            innerHtml += '<input type="radio" class="btn-check" value="' + valueToPass + '" name="options-exp" id="' + id + '" autocomplete="off">';
                            innerHtml += '<label style="margin: 0 10px -10px 0;" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="' + hallType + '" class="btn btn-outline-danger" for="' + id + '">';
                            innerHtml += '<i class="fa-solid fa-film"></i>&nbsp;' + hallType;
                            innerHtml += '</label>';
                        });
                    } else {
                        innerHtml = '<p id="pretext">No experiences available for this date.</p>';
                    }
                    $(".exp-radio").html(innerHtml);
                },
                error: function (jXHR, textStatus, errorThrown) {
                    $(".exp-radio").html('<p>Error loading experiences. Please try again.</p>');
                    console.error("Error fetching hall types:", errorThrown);
                }
            });
        } else {
            $(".exp-radio").html('<p>Please select a date.</p>');
        }
    }






    function fetchCinema() {
        var selectedHallExperience = $("input[name='options-exp']:checked").val();

        $("#accordion-container").html('<p id="pretext">Loading cinemas...</p>'); // Show loading message
        $("input[name='time']").prop('checked', false);

        if (selectedHallExperience) {
            $.ajax({
                url: "<?=ROOT?>/DetailSelection/fetchCinemaAndTime",
                type: "POST",
                data: $('#form2').serialize(),
                success: function (response) {
                    //document.writeln(JSON.stringify(response));     //Test returned results
                    var data = response.data;
                    var accordionHtml = '';
                    var cinemas = {};

                    // Organize data by cinema
                    data.forEach(function (item) {
                        var cinemaId = item.cinemaId;
                        var hallId = item.hallId;

                        // Initialize cinema group
                        if (!cinemas[cinemaId]) {
                            cinemas[cinemaId] = {
                                name: item.cinemaName,
                                halls: {}
                            };
                        }

                        // Initialize hall group
                        if (!cinemas[cinemaId].halls[hallId]) {
                            cinemas[cinemaId].halls[hallId] = {
                                name: item.hallName,
                                type: item.hallType,
                                times: []
                            };
                        }

                        // Add time slot
                        cinemas[cinemaId].halls[hallId].times.push({
                            startingTime: item.startingTime,
                            movieTitle: item.movieTitle,
                            duration: item.duration,
                            language: item.language,
                            description: item.description
                        });
                    });

                    // Generate accordion HTML
                    for (var cinemaId in cinemas) {
                        if (cinemas.hasOwnProperty(cinemaId)) {
                            var cinema = cinemas[cinemaId];
                            accordionHtml += `
                           <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#cinema-${cinemaId}" aria-expanded="false"
                                            aria-controls="cinema-${cinemaId}">
                                        <b>${cinema.name}</b>
                                    </button>
                                </h2>
                                <div id="cinema-${cinemaId}" class="accordion-collapse collapse">
                                    <div class="accordion-body" style="display: flex; flex-flow: row wrap; gap: 10px;">`;


                            for (var hallId in cinema.halls) {
                                if (cinema.halls.hasOwnProperty(hallId)) {
                                    var hall = cinema.halls[hallId];
                                    accordionHtml += `<div class="time-radio" style="max-width: fit-content;">`;

                                    hall.times.forEach(function (time, index) {
                                        var timeId = `cinema-${cinemaId}_hall-${hallId}_time-${index}`;
                                        var formattedTime = new Date(time.startingTime).toLocaleTimeString([], {
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        });
                                        accordionHtml += `
                                        <div class="radio-wrapper" style="max-width: fit-content;">
                                            <input type="radio" value="${formattedTime}" class="btn-check" name="time" id="${timeId}" autocomplete="off"
                                                data-cinema="${cinema.name}" data-cinemaID="${cinemaId}" data-date="${time.startingTime}" data-hallid="${hallId}" data-experience="${selectedHallExperience}"
                                                data-movie-title="${time.movieTitle}">
                                            <label class="btn btn-outline-danger" for="${timeId}">
                                                <div class="hall-info" style="font-size: 14px;">
                                                    ${hall.name} | ${hall.type}
                                                </div>
                                                <div class="time-info" style="font-size: 18px;">
                                                    <i class="fa-regular fa-clock"></i>&nbsp;${formattedTime}
                                                </div>
                                            </label>
                                        </div>`;
                                    });

                                    accordionHtml += `</div>`;
                                }
                            }

                            accordionHtml += `</div></div></div>`;
                        }
                    }

                    // Inject the generated HTML into the accordion container
                    $('#accordion-container').html(accordionHtml);

                    // Add event listener for opening modal
                    $("input[name='time']").on('change', function () {
                        assignValueToModal()
                        var modal = new bootstrap.Modal(document.getElementById('myModal'));
                        modal.show();
                    });

                },
                error: function (jXHR, textStatus, errorThrown) {
                    console.error("Error fetching cinema data:", errorThrown);
                    alert("Error loading cinema data. Please try again.");
                }
            });
        } else {
            alert("Please select a hall experience.");
        }
    }


    function assignValueToModal() {
        //Prepare Value
        let selectedTimeInput = document.querySelector('input[name="time"]:checked');

        let cinema = selectedTimeInput.getAttribute('data-cinema');
        let experiencePure = selectedTimeInput.getAttribute('data-experience');
        let experience = experiencePure.split("|")[0];

        let dateTime = selectedTimeInput.getAttribute('data-date');
        let combinedDateTime = formatDateTime(dateTime); //Mon 29 July, 10:30AM

        //Apply Values
        document.getElementById("experienceResult").innerText = experience;
        document.getElementById("cinemaResult").innerText = cinema;
        document.getElementById("dateTimeResult").innerText = combinedDateTime;
    }

    function formatDateTime(dateTime) {
        const date = new Date(dateTime); // Assuming dateTime is a valid date string
        const options = { weekday: 'short', day: 'numeric', month: 'long', hour: '2-digit', minute: '2-digit' };
        let formattedDate = date.toLocaleString('en-GB', options);

        // Replace "at" with ","
        formattedDate = formattedDate.replace(' at ', ', ');

        // Add AM or PM
        const hours = date.getHours();
        const period = hours >= 12 ? 'PM' : 'AM';

        return formattedDate + ' ' + period;
    }

    //Deselect time if modal close
    $('#myModal').on('hidden.bs.modal', function () {
        $("input[name='time']").prop('checked', false);
    });


    function selectSeat(){
        //Prepare Value
        let selectedTimeInput = document.querySelector('input[name="time"]:checked');

        let cinema = selectedTimeInput.getAttribute('data-cinema');
        let experiencePure = selectedTimeInput.getAttribute('data-experience');
        let experience = experiencePure.split("|")[0];

        let dateTime = selectedTimeInput.getAttribute('data-date');
        let combinedDateTime = formatDateTime(dateTime); //Mon 29 July, 10:30AM

        let hallId = selectedTimeInput.getAttribute('data-hallid');
        let cinemaId = selectedTimeInput.getAttribute('data-cinemaID');

        location.href="<?=ROOT?>/SeatSelection?cin=" + cinema +"&exp=" + experience + "&date=" + dateTime + "&hid=" + hallId + "&cid=" + cinemaId;
    }

</script>



</body>

</html>