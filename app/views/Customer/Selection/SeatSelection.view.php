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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../../../public/css/reset.css" />

    <link rel="stylesheet" href="../../../../public/css/SeatSelection.css" />
    <title>Seat Selection</title>

    <link rel="icon" type="image/x-icon" href="../../../../public/images/icon.png">
</head>

<body>

    <div class="outer-box">
        <div class="top-box">
            <div class="img-box">
                <img draggable="false" src="../../../../public/images/movie.webp" />
            </div>
            <div class="info-box">
                <div class="movie-details">
                    <div class="movie-name">
                        BOCCHI THE ROCK! Recap Part 1&nbsp;&nbsp;•&nbsp;&nbsp;RM 15.50
                    </div>
                    <div class="movie-duration">
                        <i class="fa-regular fa-clock"></i>&nbsp;2 Hours 2 Minutes
                    </div>
                </div>
                <div class="select-details">
                    <div class="s-box">
                        <p class="s-title">
                            <i class="fa-solid fa-film"></i>&nbsp;Cinema
                        </p>
                        <p class="det">
                            PAVILION BUKIT JALIL
                        </p>
                    </div>
                    <div class="s-box">
                        <p class="s-title">
                            <i class="fa-solid fa-film"></i>&nbsp;Experience
                        </p>
                        <p class="det">
                            Deluxe
                        </p>
                    </div>
                    <div class="s-box">
                        <p class="s-title">
                            <i class="fa-solid fa-calendar-days"></i>&nbsp;Date & Time
                        </p>
                        <p class="det">
                            Mon 29 July, 10:30AM
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="middle-box">
            <div class="cancel-btn">
                <button onclick="location.href='DetailSelection.html'" type="button" class="btn btn-danger"><i
                        class="fa-solid fa-angle-left"></i>&nbsp;Back</button>
            </div>

            <div class="inmiddle">

                <img src="../../../../public/images/screen.png" draggable="false" />

                <div class="screen-tt">
                    Screen
                </div>

            </div>
        </div>


        <div class="bottom-box seats">
            <div class="row" data-row="A">
                <div class="seatrowtitle">A</div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row" data-row="B">
                <div class="seatrowtitle">B</div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat occupied"></div>
                <div class="seat occupied"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row" data-row="C">
                <div class="seatrowtitle">C</div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat occupied"></div>
                <div class="seat occupied"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row" data-row="D">
                <div class="seatrowtitle">D</div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row" data-row="E">
                <div class="seatrowtitle">E</div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat occupied"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row" data-row="F">
                <div class="seatrowtitle">F</div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat occupied"></div>
                <div class="seat occupied"></div>
                <div class="seat occupied"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row" data-row="G">
                <div class="seatrowtitle">G</div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat occupied"></div>
                <div class="seat occupied"></div>
                <div class="seat occupied"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row" data-row="H">
                <div class="seatrowtitle">H</div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat occupied"></div>
                <div class="seat occupied"></div>
                <div class="seat occupied"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row" data-row="I">
                <div class="seatrowtitle">I</div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat occupied"></div>
                <div class="seat occupied"></div>
                <div class="seat occupied"></div>
                <div class="seat"></div>
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
    </div>

    <div class="footer-box">
        <div class="left-b">
            <div class="lbtt">
                Seat Selection
            </div>
            <div id="listOfSeat" class="listOfSeat">
                <!--Show all seats selected by user-->
            </div>
        </div>
        <div class="right-b">
            <div id="ttPrice" class="outerright">
                <!--Display Total Price-->
                Total: RM 0.00
            </div>
            <div class="innerright">
                <div>
                    <button id="reset" type="button" class="btn btn-secondary">Reset</button>
                </div>
                <div>
                    <button type="button" class="btn btn-light">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.querySelector('.bottom-box');
        const seats = document.querySelectorAll('.row .seat:not(.occupied)');

        //Seat click event
        container.addEventListener('click', e => {
            if (e.target.classList.contains('seat') &&
                !e.target.classList.contains('occupied')) {
                e.target.classList.toggle('selected');
            }
            updateSelectedCount();
        });

        //Display seat no in the circle
        const rows = document.querySelectorAll('.row');
        rows.forEach((row, rowIndex) => {
            const seats = row.querySelectorAll('.seat');
            seats.forEach((seat, seatIndex) => {
                if (!seat.classList.contains("occupied")) {
                    seat.innerText = seatIndex + 1;
                } else {
                    const icon = document.createElement('i');
                    icon.className = 'fa-solid fa-user';
                    seat.appendChild(icon);
                    seatIndex++;
                }
            });
        });

        //Reset all selected seats
        const resetBtn = document.querySelector("#reset");
        resetBtn.addEventListener('click', e => {
            const selectedSeats = document.querySelectorAll('.row .seat.selected');
            selectedSeats.forEach(seat => {
                seat.classList.remove('selected');
            });
            updateSelectedCount();
        })


        //Update total and count
        function updateSelectedCount() {
            //Seat
            var seatArray = [];
            const seatResult = document.querySelector("#listOfSeat");
            const selectedSeats = document.querySelectorAll('.row .seat.selected');
            selectedSeats.forEach(seat => {
                //Get row character
                const row = seat.closest('.row').getAttribute('data-row');
                seatArray.push(row + seat.innerHTML);
            });
            seatResult.innerHTML = seatArray.join(', ');



            //Price
            const moviePrice = 15.5;
            const totalPriceResult = document.querySelector("#ttPrice");
            var count = seatArray.length;
            var total = moviePrice * count;

            totalPriceResult.innerHTML = "Total: RM " + total.toFixed(2);
        }

    </script>
</body>

</html>