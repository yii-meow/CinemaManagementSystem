<!DOCTYPE html>
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

            <!-- Base Ticket Prices -->
            <section class="pricing-section">
                <div
                        class="pricing-header d-flex justify-content-between align-items-center"
                >
                    <h2 class="h4">Base Ticket Prices</h2>
                    <button
                            class="btn btn-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editBasePricesModal"
                    >
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
                        <td>IMAX</td>
                        <td>18.00</td>
                    </tr>
                    <tr>
                        <td>DELUXE</td>
                        <td>25.00</td>
                    </tr>
                    <tr>
                        <td>ATMOS</td>
                        <td>45.00</td>
                    </tr>
                    <tr>
                        <td>BENIE</td>
                        <td>70.00</td>
                    </tr>
                    </tbody>
                </table>
            </section>

            <!-- Time-based Pricing -->
            <section class="pricing-section">
                <div
                        class="pricing-header d-flex justify-content-between align-items-center"
                >
                    <h2 class="h4">Time-based Pricing</h2>
                    <button
                            class="btn btn-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editTimePricingModal"
                    >
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
                        <td>Weekday (Before 12 PM)</td>
                        <td>-20%</td>
                    </tr>
                    <tr>
                        <td>Weekday (After 12 PM)</td>
                        <td>No adjustment</td>
                    </tr>
                    <tr>
                        <td>Weekend</td>
                        <td>+10%</td>
                    </tr>
                    <tr>
                        <td>Midnight (After 11 PM)</td>
                        <td>-10%</td>
                    </tr>
                    </tbody>
                </table>
            </section>

            <!-- Special Pricing Rules -->
            <section class="pricing-section">
                <div
                        class="pricing-header d-flex justify-content-between align-items-center"
                >
                    <h2 class="h4">Special Pricing Rules</h2>
                    <button
                            class="btn btn-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editSpecialRulesModal"
                    >
                        <i class="fas fa-edit"></i> Edit Special Rules
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
                        <td>Children (Below 12)</td>
                        <td>-30%</td>
                    </tr>
                    <tr>
                        <td>Students</td>
                        <td>-15%</td>
                    </tr>
                    <tr>
                        <td>Seniors (Above 60)</td>
                        <td>-15%</td>
                    </tr>
                    </tbody>
                </table>
            </section>

            <!-- Discounts -->
            <section class="pricing-section">
                <div
                        class="pricing-header d-flex justify-content-between align-items-center"
                >
                    <h2 class="h4">Commission Fee</h2>
                    <button
                            class="btn btn-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editSpecialRulesModal"
                    >
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
                        <td>Commission Fee</td>
                        <td>1.5%</td>
                    </tr>
                    </tbody>
                </table>
            </section>


        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>