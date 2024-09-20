<?php

use App\core\Encryption;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
    <!-- <link rel="stylesheet" href="../reset.css" /> -->

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/UserManage.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/AdminCinemaManagement.css"/>
    <title>User Ticket</title>

    <style>
        td {
            padding: 15px !important;
        }
    </style>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png"/>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include '../app/views/adminSidebar.php' ?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h1 class="h2">
                    <i class="fas fa-user me-2"></i>User Ticket Management
                </h1>
            </div>

            <!-- Filters and Sorting -->
            <div class="row mb-4">
                <div>
                    <form method="POST"
                          style="display: flex; flex-flow: row nowrap; justify-content: space-between !important;">
                        <div class="input-group" style="max-width: 600px;">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input id="myInput" onkeyup="filterTable()" type="text" class="form-control" name="search"
                                   placeholder="Search ticket..."
                                   value="<?= htmlspecialchars($searchQuery ?? '', ENT_QUOTES, 'UTF-8'); ?>"/>
                        </div>
                        <div class="exportButton" style="display:flex; flex-flow: row nowrap; gap:10px;">
                            <button onclick="location.href='<?= ROOT ?>/UserPurchasedTicket/exportPDF'" type="button"
                                    class="btn btn-primary">Show XSLT
                            </button>
                            <button onclick="location.href='<?= ROOT ?>/UserPurchasedTicket/exportCSV'" type="button"
                                    class="btn btn-success">Export CSV
                            </button>
                            <button onclick="location.href='<?= ROOT ?>/UserPurchasedTicket/exportPDF'" type="button"
                                    class="btn btn-danger">Export PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ticket list -->
            <table class="table" id="myTable">
                <thead class="thead-dark" style="background-color: rgb(39, 37, 37); color:white;">
                <tr>
                    <th scope="col" style="padding:10px;width: 3%; vertical-align: middle">No.</th>
                    <th scope="col" style="padding:10px;width: 8%; vertical-align: middle">Username</th>
                    <th scope="col" style="padding:10px;width: 10%; vertical-align: middle">Ticket Status</th>
                    <th scope="col" style="padding:10px;width: 10%; vertical-align: middle">Payment Status</th>
                    <th scope="col" style="padding:10px;width: 12%; vertical-align: middle">Movie Name</th>
                    <th scope="col" style="padding:10px;width: 10%; vertical-align: middle">Date & Time</th>
                    <th scope="col" style="padding:10px;width: 10%; vertical-align: middle">Seat Numbers</th>
                    <th scope="col" style="padding:10px;width: 8%; vertical-align: middle">Total Price</th>
                    <th scope="col" style="padding:10px;width: 5%; text-align: center; vertical-align: middle">Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if (isset($tickets) && !empty($tickets)): ?>
                    <?php foreach ($tickets as $index => $ticket): ?>
                        <tr>
                            <th scope="row" style="padding: 15px !important"><?= $index + 1 ?></th>
                            <td><?= htmlspecialchars($ticket['customerName'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($ticket['ticketStatus'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($ticket['paymentStatus'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($ticket['movieTitle'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($ticket['startingTime']->format('Y-m-d H:i A'), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($ticket['seatNo'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= "RM " . number_format($ticket['totalPrice'], 2); ?></td>
                            <td style="text-align: center;">

                                <?php
                                //Encryption Process
                                $encryption = new Encryption();
                                $encryptedTicketId = $encryption->encrypt($ticket['ticketId'], $encryption->getKey());
                                ?>
                                <a href="<?= ROOT ?>/UserTicketView?ticketId=<?= $encryptedTicketId ?>">
                                    <button style="width: 100%;" class="btn btn-md btn-outline-primary me-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>View
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No tickets found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<script>
    function filterTable() {
        // Declare variables
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows (except the header row)
        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = "none"; // Hide the row initially

            // Loop through all table data (td) in the current row
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = ""; // Show the row if match found
                        break; // Stop searching in this row if a match is found
                    }
                }
            }
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>