
<?php
/**
 * @Chew Zi An
 */
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

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/UserManage.css"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/AdminCinemaManagement.css"/>
    <title>User Management</title>

    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png"/>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php include '../app/views/adminSidebar.php' ?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <h1 class="mb-2">User Ticket Details</h1>

            <!-- Display User Details -->
            <form method="post" action="<?=ROOT?>/UserTicketView/UpdateRecord" id="userDetailsForm" class="main-content p-4 mt-3" style="
                                            background-color: #ffffff;
                                            border-radius: 8px;
                                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                        ">
                <div class="mb-3">
                    <div id="alertPlaceholder"></div>
                    <label for="ticketId" class="form-label">Ticket ID</label>
                    <input type="text" class="form-control" id="ticketId"
                           value="<?php if(isset($ticket)){ echo $ticket[0]['ticketId']; }?>" required disabled/>
                </div>

                <div class="mb-3">
                    <label for="customerName" class="form-label">Username</label>
                    <input type="text" class="form-control" id="customerName"
                           value="<?php if(isset($ticket)){ echo $ticket[0]['customerName']; }?>" required disabled/>
                </div>

                <div class="mb-3">
                    <label for="movieTitle" class="form-label">Movie Name</label>
                    <input type="text" class="form-control" id="movieTitle"
                           value="<?php if(isset($ticket)){ echo $ticket[0]['movieTitle']; }?>" required disabled/>
                </div>

                <div class="mb-3">
                    <label for="datetime" class="form-label">Date & Time</label>
                    <input type="text" class="form-control" id="datetime"
                           value="<?php if(isset($ticket)){ echo $ticket[0]['startingTime']->format('d M Y, H:i A'); }?>" required disabled/>
                </div>

                <div class="mb-3">
                    <label for="seats" class="form-label">Seats No</label>
                    <input type="text" class="form-control" id="seats"
                           value="<?php if(isset($ticket)){ echo $ticket[0]['seatNo']; }?>" required disabled/>
                </div>

                <div class="mb-3">
                    <label for="seats" class="form-label">Seats No</label>
                    <input type="text" class="form-control" id="seats"
                           value="<?php if(isset($ticket)){ echo "RM " . $ticket[0]['totalPrice']; }?>" required disabled/>
                </div>


                <!--Allow to change payment status & ticket status-->
                <div class="mb-3">
                    <label for="ticketStatus" class="form-label">Ticket Status</label>
                    <select  name="ticketStatus" class="form-select" aria-label="Default select example" id="ticketStatus">
                        <option value="Upcoming" <?php echo $ticket[0]['ticketStatus'] == "Upcoming" ? 'selected' : ''; ?>>Upcoming</option>
                        <option value="Past" <?php echo $ticket[0]['ticketStatus'] == "Past" ? 'selected' : ''; ?>>Past</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="paymentStatus" class="form-label">Payment Status</label>
                    <select name="paymentStatus"  class="form-select" aria-label="Default select example" id="paymentStatus">
                        <option value="Paid" <?php echo $ticket[0]['paymentStatus'] == "Paid" ? 'selected' : ''; ?>>Paid</option>
                        <option value="Unpaid" <?php echo $ticket[0]['paymentStatus'] == "Unpaid" ? 'selected' : ''; ?>>Unpaid</option>
                    </select>
                </div>
                <br/>


                <input type="hidden" value="<?=$ticket[0]['ticketId']?>" name="ticketId" />
                <input type="hidden" value="<?= $_SERVER['REQUEST_URI']; ?>" name="direction" />

                <div style="display: flex; flex-flow: row nowrap; justify-content: right; gap: 8px;">
                    <a href="UserPurchasedTicket" class="btn btn-primary">Back</a>
                    <button type="submit" style="background-color: green" class="btn btn-secondary" id="statusButton">
                        Update
                    </button>
                </div>
            </form>
        </main>
    </div>
</div>
<br>


<script>
    $(document).ready(function () {
        // Handle form submission
        $('#statusButton').click(function (e) {
            e.preventDefault(); // Prevent default form submission

            $.ajax({
                url: "<?=ROOT?>/UserTicketView/UpdateRecord", // The URL to your PHP controller method
                type: "POST",
                data: $('#userDetailsForm').serialize(), // Serialize the form data
                success: function (response) {
                    // Show success alert
                    showAlert('success', 'Record updated successfully!');
                },
                error: function (jXHR, textStatus, errorThrown) {
                    // Show error alert
                    showAlert('danger', 'Error updating record. Please try again.');
                    console.error("Error:", errorThrown);
                }
            });
        });

        // Function to display Bootstrap alert
        function showAlert(type, message) {
            var alertHtml = `
            <div class="alert alert-` + type + ` alert-dismissible fade show" role="alert">
                ` + message + `
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
            $('#alertPlaceholder').html(alertHtml);
        }


    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>