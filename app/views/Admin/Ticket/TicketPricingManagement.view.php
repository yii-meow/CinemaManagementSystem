<!DOCTYPE html>
<!--
/**
 * @author Chong Yik Soon
 */
 -->
<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
            rel="stylesheet"
    />
    <link
            href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
            rel="stylesheet"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
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

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/AdminCinemaManagement.css"/>
    <title>Cinemas Details</title>

    <link rel="icon" type="image/x-icon" href="../Media/Image/icon.png"/>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include(dirname(__DIR__) . '../../adminSidebar.php') ?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
            <h1 class="h2 mb-4">Pricing Management</h1>

            <!-- Display success or error messages -->
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success" role="alert">
                    Pricing updated successfully!
                </div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    An error occurred while updating pricing.
                </div>
            <?php endif; ?>

            <!-- Base Ticket Prices -->
            <section class="pricing-section">
                <div class="pricing-header d-flex justify-content-between align-items-center">
                    <h2 class="h4">Base Ticket Prices</h2>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editBasePricesModal">
                        <i class="fas fa-edit"></i> Edit Prices
                    </button>
                </div>
                <table class="table table-hover pricing-table">
                    <thead>
                    <tr>
                        <th>Ticket Type</th>
                        <th>Price (MYR)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="w-75">IMAX</td>
                        <td><?= $ticketPricing->getBaseTicketIMAX() ?></td>
                    </tr>
                    <tr>
                        <td>DELUXE</td>
                        <td><?= $ticketPricing->getBaseTicketDeluxe() ?></td>
                    </tr>
                    <tr>
                        <td>ATMOS</td>
                        <td><?= $ticketPricing->getBaseTicketAtmos() ?></td>
                    </tr>
                    <tr>
                        <td>BENIE</td>
                        <td><?= $ticketPricing->getBaseTicketBenie() ?></td>
                    </tr>
                    </tbody>
                </table>
            </section>

            <!-- Time-based Pricing -->
            <section class="pricing-section">
                <div class="pricing-header d-flex justify-content-between align-items-center">
                    <h2 class="h4">Time-based Pricing</h2>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTimePricingModal">
                        <i class="fas fa-edit"></i> Edit Time-based Pricing
                    </button>
                </div>
                <table class="table table-hover pricing-table">
                    <thead>
                    <tr>
                        <th>Time Period</th>
                        <th>Price Adjustment</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="w-75">Weekday (Before 12 PM)</td>
                        <td><?= $ticketPricing->getTimeBasedWeekdayBefore12() ?>%</td>
                    </tr>
                    <tr>
                        <td>Weekday (After 12 PM)</td>
                        <td><?= $ticketPricing->getTimeBasedWeekdayAfter12() ?>%</td>
                    </tr>
                    <tr>
                        <td>Weekend</td>
                        <td><?= $ticketPricing->getTimeBasedWeekend() ?>%</td>
                    </tr>
                    <tr>
                        <td>Midnight (After 11 PM)</td>
                        <td><?= $ticketPricing->getTimeBasedMidnight() ?>%</td>
                    </tr>
                    </tbody>
                </table>
            </section>

            <!-- Commission Fee -->
            <section class="pricing-section">
                <div class="pricing-header d-flex justify-content-between align-items-center">
                    <h2 class="h4">Commission Fee</h2>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCommissionModal">
                        <i class="fas fa-edit"></i> Edit Commission Fee
                    </button>
                </div>
                <table class="table table-hover pricing-table">
                    <thead>
                    <tr>
                        <th>Category</th>
                        <th>Rule</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="w-75">Commission Fee</td>
                        <td><?= $ticketPricing->getCommissionFee() ?>%</td>
                    </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</div>

<!-- Modals for editing pricing -->
<!-- Base Prices Modal -->
<div class="modal fade" id="editBasePricesModal" tabindex="-1" aria-labelledby="editBasePricesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBasePricesModalLabel">Edit Base Ticket Prices</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= ROOT ?>/TicketPricingManagement/updatePricing" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="baseTicketIMAX" class="form-label">IMAX Price</label>
                        <input type="number" class="form-control" id="baseTicketIMAX" name="baseTicketIMAX" value="<?= $ticketPricing->getBaseTicketIMAX() ?>" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="baseTicketDeluxe" class="form-label">DELUXE Price</label>
                        <input type="number" class="form-control" id="baseTicketDeluxe" name="baseTicketDeluxe" value="<?= $ticketPricing->getBaseTicketDeluxe() ?>" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="baseTicketAtmos" class="form-label">ATMOS Price</label>
                        <input type="number" class="form-control" id="baseTicketAtmos" name="baseTicketAtmos" value="<?= $ticketPricing->getBaseTicketAtmos() ?>" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="baseTicketBenie" class="form-label">BENIE Price</label>
                        <input type="number" class="form-control" id="baseTicketBenie" name="baseTicketBenie" value="<?= $ticketPricing->getBaseTicketBenie() ?>" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Time-based Pricing Modal -->
<div class="modal fade" id="editTimePricingModal" tabindex="-1" aria-labelledby="editTimePricingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTimePricingModalLabel">Edit Time-based Pricing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= ROOT ?>/TicketPricingManagement/updatePricing" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="timeBasedWeekdayBefore12" class="form-label">Weekday (Before 12 PM) Adjustment</label>
                        <input type="number" class="form-control" id="timeBasedWeekdayBefore12" name="timeBasedWeekdayBefore12" value="<?= $ticketPricing->getTimeBasedWeekdayBefore12() ?>" step="0.1" required>
                    </div>
                    <div class="mb-3">
                        <label for="timeBasedWeekdayAfter12" class="form-label">Weekday (After 12 PM) Adjustment</label>
                        <input type="number" class="form-control" id="timeBasedWeekdayAfter12" name="timeBasedWeekdayAfter12" value="<?= $ticketPricing->getTimeBasedWeekdayAfter12() ?>" step="0.1" required>
                    </div>
                    <div class="mb-3">
                        <label for="timeBasedWeekend" class="form-label">Weekend Adjustment</label>
                        <input type="number" class="form-control" id="timeBasedWeekend" name="timeBasedWeekend" value="<?= $ticketPricing->getTimeBasedWeekend() ?>" step="0.1" required>
                    </div>
                    <div class="mb-3">
                        <label for="timeBasedMidnight" class="form-label">Midnight (After 11 PM) Adjustment</label>
                        <input type="number" class="form-control" id="timeBasedMidnight" name="timeBasedMidnight" value="<?= $ticketPricing->getTimeBasedMidnight() ?>" step="0.1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Commission Fee Modal -->
<div class="modal fade" id="editCommissionModal" tabindex="-1" aria-labelledby="editCommissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommissionModalLabel">Edit Commission Fee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= ROOT ?>/TicketPricingManagement/updatePricing" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="commissionFee" class="form-label">Commission Fee (%)</label>
                        <input type="number" class="form-control" id="commissionFee" name="commissionFee" value="<?= $ticketPricing->getCommissionFee() ?>" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to handle form submissions
        function handleFormSubmit(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        alert('Pricing updated successfully!');
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert('Error updating pricing. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        }

        // Add event listeners to all forms in modals
        const forms = document.querySelectorAll('.modal form');
        forms.forEach(form => {
            form.addEventListener('submit', handleFormSubmit);
        });
    });
</script>
</body>
</html>