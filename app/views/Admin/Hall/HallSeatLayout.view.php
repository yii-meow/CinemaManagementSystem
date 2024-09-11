<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <link
        href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
        rel="stylesheet"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
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
    <!-- <link rel="stylesheet" href="../reset.css" /> -->

    <link rel="stylesheet" href="../../../../public/css/AdminCinemaManagement.css" />
    <link rel="stylesheet" href="../../Selection/SeatSelection.css" />
    <title>Cinemas Management</title>

    <link rel="icon" type="image/x-icon" href="../Media/Image/icon.png" />
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block p-0">
            <div class="sidebar-container">
                <div class="sidebar p-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-film me-4 fa-lg"></i>
                                Cinemas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-calendar-alt me-4 fa-lg"></i>
                                Movie & Showtimes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-ticket-alt me-4 fa-lg"></i>
                                Bookings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="AdminForum.html">
                                <i class="fa fa-users me-4 fa-lg"></i>
                                Forum
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-bar me-4 fa-lg"></i>
                                Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-4 fa-lg"></i>
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Admin Info -->
                <div class="admin-info">
                    <div class="d-flex align-items-center mb-2">
                        <img
                            src="/Media/Image/pp.webp"
                            alt="Admin Avatar"
                            class="me-2"
                        />
                        <div>
                            <strong>John Doe</strong>
                            <div class="small text-muted">Admin</div>
                        </div>
                    </div>
                    <button class="btn btn-outline-light btn-sm w-100">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <main
            class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3"
            style="background-color: #141414"
        >
            <div class="cancel-btn">
                <button
                    onclick="history.back()"
                    type="button"
                    class="btn btn-danger"
                >
                    <i class="fa-solid fa-angle-left"></i>&nbsp;Back
                </button>
            </div>
            <div class="d-flex align-items-center">
                <h1 class="mb-2">Seating Layout</h1>
                <i class="fa fa-users ms-3 fa-lg"></i>
            </div>

            <div
                class="layout-container d-flex justify-content-between mt-2 px-5"
            >
                <div class="seats-container">
                    <div class="middle-box">
                        <div class="inmiddle">
                            <img src="../../Media/Image/screen.png" draggable="false" />
                            <div class="screen-tt">Screen</div>
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
                            <div class="seat"></div>
                            <div class="seat"></div>
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
                            <div class="seat"></div>
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
                            <div class="seat"></div>
                            <div class="seat"></div>
                            <div class="seat"></div>
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
                            <div class="seat"></div>
                            <div class="seat"></div>
                            <div class="seat"></div>
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
                            <div class="seat"></div>
                            <div class="seat"></div>
                            <div class="seat"></div>
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
                            <div class="seat"></div>
                            <div class="seat"></div>
                            <div class="seat"></div>
                            <div class="seat"></div>
                        </div>
                    </div>
                </div>

                <div class="buttons-container">
                    <div>
                <span class="text-secondary"
                >(Please select one or more seat)</span
                >
                        <button class="bg-danger text-light rounded-0 p-2 w-100">
                            Mark Seat(s) as Available / Unavailable
                        </button>
                    </div>
                    <div>
                <span class="text-secondary"
                >(Please select one or more seat)</span
                >
                        <button class="bg-danger text-light rounded-0 p-2 w-100">
                            Change Seat(s) Category
                        </button>
                    </div>
                    <button class="bg-danger text-light rounded-0 p-2 w-100">
                        Change Total Seats Available
                    </button>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    const container = document.querySelector(".bottom-box");
    const seats = document.querySelectorAll(".row .seat:not(.occupied)");

    //Seat click event
    container.addEventListener("click", (e) => {
        if (
            e.target.classList.contains("seat") &&
            !e.target.classList.contains("occupied")
        ) {
            e.target.classList.toggle("selected");
        }
        updateSelectedCount();
    });

    //Display seat no in the circle
    const rows = document.querySelectorAll(".row");
    rows.forEach((row, rowIndex) => {
        const seats = row.querySelectorAll(".seat");
        seats.forEach((seat, seatIndex) => {
            if (!seat.classList.contains("occupied")) {
                seat.innerText = seatIndex + 1;
            } else {
                const icon = document.createElement("i");
                icon.className = "fa-solid fa-user";
                seat.appendChild(icon);
                seatIndex++;
            }
        });
    });

    //Reset all selected seats
    const resetBtn = document.querySelector("#reset");
    resetBtn.addEventListener("click", (e) => {
        const selectedSeats = document.querySelectorAll(".row .seat.selected");
        selectedSeats.forEach((seat) => {
            seat.classList.remove("selected");
        });
        updateSelectedCount();
    });

    //Update total and count
    function updateSelectedCount() {
        //Seat
        var seatArray = [];
        const seatResult = document.querySelector("#listOfSeat");
        const selectedSeats = document.querySelectorAll(".row .seat.selected");
        selectedSeats.forEach((seat) => {
            //Get row character
            const row = seat.closest(".row").getAttribute("data-row");
            seatArray.push(row + seat.innerHTML);
        });
        seatResult.innerHTML = seatArray.join(", ");

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
