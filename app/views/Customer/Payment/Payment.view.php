<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="<?= ROOT ?>/assets/css/Payment.css" rel="stylesheet"/>

    <title>Payment</title>
    <link rel="icon" type="image/x-icon" href="<?= ROOT ?>/assets/images/icon.png"/>

    <style>
        /* For WebKit browsers (Chrome, Safari) */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
<form method="POST" id="form1">

    <div class="all-container">
        <!-- Payment side -->
        <div class="left-box">
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/alternativeIcon.png" draggable="false" style="border-radius: 5px;"
                     width="300" ID="imgLogo"/>
            </div>
            <div class="cont">

                <span class="small-title">Payment Methods
                </span>
                <!-- Payment method -->
                <div id="alerts"></div>
                <div class="supported-methods">

                    <div class="pay">
                        <input type="radio" class="btn-check" value="cash" name="payoption" id="pay1"
                               autocomplete="off">
                        <label data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Cash"
                               class="btn btn-outline-danger" for="pay1">
                            <img src="<?= ROOT ?>/assets/images/cash.png" draggable="false"/>&nbsp;Cash
                        </label>
                    </div>

                    <div class="pay">
                        <input type="radio" class="btn-check" value="tng" name="payoption" id="pay2"
                               autocomplete="off">
                        <label data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Touch 'n Go e-Wallet"
                               class="btn btn-outline-danger" for="pay2">
                            <img src="<?= ROOT ?>/assets/images/tng.png" draggable="false"/>&nbsp;Touch 'n Go e-Wallet
                        </label>
                    </div>

                    <div class="pay">
                        <input type="radio" class="btn-check" value="grab" name="payoption" id="pay3"
                               autocomplete="off">
                        <label data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="GrabPay"
                               class="btn btn-outline-danger" for="pay3">
                            <img src="<?= ROOT ?>/assets/images/grab.png " draggable="false"/>&nbsp;GrabPay
                        </label>
                    </div>

                </div>
                <!-- End select payment method -->
            </div>
            <div class="formdetail" autocomplete="off">
                <div class="fill">
                    <div class="title">
                        Booking Information
                    </div>
                    <div class="box2">
                        <div class="name">
                            <div class="form-floating fname">
                                <input type="text" id="txtFirstName" class="form-control" placeholder="First Name"
                                       name="fName" autocomplete="off"/>
                                <label for="txtFirstName">First Name</label>
                            </div>
                            <div class="form-floating lname">
                                <input type="text" id="txtLastName" class="form-control" placeholder="Last Name"
                                       name="lName" autocomplete="off"/>
                                <label for="txtLastName">Last Name</label>
                            </div>
                        </div>
                        <div class="form-floating email">
                            <input name="email" type="email" id="txtEmail" class="form-control" placeholder="Email"/>
                            <label for="txtEmail">Email</label>
                        </div>
                        <div class="form-floating phone">
                            <input name="phone" type="tel" id="txtPhone" class="form-control" placeholder="Phone"/>
                            <label for="txtPhone">Phone</label>
                        </div>
                        <div class="askVoucher">
                            <div class="form-check check-box">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" style="color: #f03351; text-decoration: underline;"
                                       for="flexCheckDefault">
                                    I HAVE A PROMO CODE
                                </label>
                            </div>
                            <div class="voucher" style="width:100%; gap:10px; display: none;" id="voucherbox">
                                <div style="width:80%" class="form-floating voucher">
                                    <input name="promoCode" type="number" id="voucher" class="form-control"
                                           placeholder="Promo Code">
                                    <label for="voucher">Promo Code</label>
                                </div>
                                <div style="width:20%" class="form-floating">
                                    <input style="width: 100%; height: 100%" name="applyPromo" id="applyPromo"
                                           type="button" value="Apply" class="btn btn-danger">
                                </div>
                            </div>
                            <div style="margin-top: 10px;" id="alertPromo"></div>
                        </div>
                    </div>
                </div>
                <div class="checkout">
                    <button type="button" onclick="history.back()" class="btn btn-secondary">Cancel</button>
                    <button type="button" id="submitBtn" class="btn btn-danger">Checkout</button>
                </div>
            </div>
        </div>

        <!-- Info Side -->
        <div class="right-box">
            <input type="hidden" id="hdnID" value=""/>
            <!--An Item-->
            <div class="products">
                <div class="text">
                    <div class="pdtt">
                        Ticket Details :
                    </div>
                    <table class="product-details">
                        <tr class="detail">
                            <td class="title-d">Movie Name :
                            </td>
                            <td class="answer">
                                <span>
                                    <?php
                                    if (isset($data)) {
                                        echo $data["movie"]["title"];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr class="detail">
                            <td class="title-d">Date & Time :
                            </td>
                            <td class="answer">
                            <span>
                                  <?php
                                  if (isset($data)) {
                                      $dateTime = $data["qs"]["date"]; // Example: "2024-09-16 18:30:00.000000"
                                      $dateTimeObj = new \DateTime($dateTime);
                                      echo $dateTimeObj->format('D d M, h:iA');
                                  }
                                  ?>
                            </span>
                            </td>
                        </tr>
                        <tr class="detail">
                            <td class="title-d">Experience :
                            </td>
                            <td class="answer">
                            <span>
                                <?php
                                if (isset($data)) {
                                    echo $data["cinemaHall"]["hallType"];
                                }
                                ?>
                            </span>
                            </td>
                        </tr>
                        <tr class="detail">
                            <td class="title-d">Cinema :
                            </td>
                            <td class="answer">
                            <span>
                                <?php
                                if (isset($data)) {
                                    echo $data["cinemaHall"]["cinema"]["cinemaName"];
                                }
                                ?>
                            </span>
                            </td>
                        </tr>
                        <tr class="detail">
                            <td class="title-d">Hall :
                            </td>
                            <td class="answer">
                            <span>
                            <?php
                            if (isset($data)) {
                                echo $data["cinemaHall"]["hallName"];
                            }
                            ?>
                            </span>
                            </td>
                        </tr>
                        <tr class="detail">
                            <td class="title-d">Seats :
                            </td>
                            <td class="answer">
                            <span>
                                <?php
                                if (isset($data)) {
                                    $listOfSeats = explode("|", $data["qs"]["seats"]);
                                    $counter = 0; // Initialize a counter

                                    foreach ($listOfSeats as $seat) {
                                        echo $seat;
                                        $counter++;
                                        // Add a comma after each seat except the last one
                                        if ($counter < count($listOfSeats)) {
                                            echo ", ";
                                        }
                                    }
                                }
                                ?>
                            </span>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
            <!--End of An Item-->
            <hr/>
            <!-- Final payment info -->
            <table class="payment">
                <tr class="subtotal">
                    <td class="tt t2">Total :
                    </td>
                    <td style="text-align: left">
                        <span id="lblTotal">RM&nbsp;<?php if (isset($data)) {
                                echo number_format($data["amount"]["totalTicketPrice"], 2);
                            } ?></span>
                    </td>
                </tr>
                <tr class="discount">
                    <td class="tt t2">Promo Code Discount :
                    </td>
                    <td style="text-align: left">
                        <span id="discount-amt">-</span>
                    </td>
                </tr>
                <tr class="pcode">
                    <td class="tt t2">Promo Code :
                    </td>
                    <td style="text-align: left">
                        <span id="pcode-no">-</span>
                    </td>
                </tr>
                <tr class="tax">
                    <td class="tt t2">SST Tax (6%) :
                    </td>
                    <td style="text-align: left">
                        <span id="tax">RM&nbsp;<?php if (isset($data)) {
                                echo number_format($data["amount"]["sst"], 2);
                            } ?></span>
                    </td>
                </tr>
                <tr class="processingfee">
                    <td class="tt t2">Processing Fee (1.5%):
                    </td>
                    <td style="text-align: left">
                        <span id="processingfee">RM&nbsp;<?php if (isset($data)) {
                                echo number_format($data["amount"]["commissionFee"], 2);
                            } ?></span>
                    </td>
                </tr>
            </table>

            <hr/>

            <div class="all-total">
                <div class="tt">Overall Total :</div>
                <div>
                    RM&nbsp;<span id="alltotal"><?php if (isset($data)) {
                            echo number_format($data["amount"]["finalPrice"], 2);
                        } ?></span>
                </div>
            </div>
        </div>
    </div>

    <!--Data to Pass to Controller-->
    <input type="hidden" name="hallType" value="<?php if (isset($data)) {
        echo $data["cinemaHall"]["hallType"];
    } ?>"/>

    <input type="hidden" name="selectedDateTime" value="<?php if (isset($data)) {
        echo $data["qs"]["date"];
    } ?>"/>

    <input type="hidden" name="seatsNo" value="<?php if (isset($data)) {
        echo $data["qs"]["seats"];
    } ?>"/>

    <input type="hidden" name="finalPrice" value="<?php if (isset($data)) {
        echo number_format($data["amount"]["finalPrice"], 2);
    } ?>"/>

</form>

<script type="text/javascript">
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


    const checkboxVoucher = document.querySelector("#flexCheckDefault");
    checkboxVoucher.addEventListener("click", function () {
        const voucherBox = document.querySelector("#voucherbox");
        const voucherInputBox = document.querySelector("#voucher");
        if (checkboxVoucher.checked) {
            voucherBox.style.display = "flex";
        } else {
            voucherBox.style.display = "none";
            voucherInputBox.value = "";

            //Update the promo details
            $('#alertPromo').empty(); // Clear previous alerts
            document.getElementById("discount-amt").innerHTML = "-";
            document.getElementById("pcode-no").innerHTML = "-";

            //Get the final price and update
            document.getElementById("alltotal").innerHTML = <?php if (isset($data)) {
                echo number_format($data["amount"]["finalPrice"], 2);
            } ?>;

            promoApplied = false
            document.getElementById("voucher").readOnly = false;
        }
    })

</script>


<script>
    $.ajaxSetup({
        cache: false
    });

    $(document).ready(function () {
        // Bind the click event directly when the DOM is ready
        $('#submitBtn').click(function (e) {
            e.preventDefault();  // Prevent default form submission
            submitPurchase();    // Call the submit function
        });

        $('#applyPromo').click(function (e) {
            e.preventDefault();  // Prevent default form submission
            applyPromoCode();    // Call the submit function
        });
    });

    function submitPurchase() {
        $.ajax({
                url: "<?=ROOT?>/Payment/processPayment",
                type: "POST",
                data: $('#form1').serialize(),
                success: function (response) {
                    var data = response.data;

                    //////Testing
                    //document.writeln(data)
                    // document.writeln(response)
                    // document.writeln(JSON.stringify(response.data));

                    $('#alerts').empty(); // Clear previous alerts

                    if (response.data && response.data.errors) {
                        // Create a single alert box
                        const alertDiv = $('<div class="alert alert-danger" role="alert"></div>');

                        // Create an unordered list
                        const ul = $('<ul style="padding-bottom: 0; margin-bottom: 0"></ul>');

                        // Append each error message as a list item
                        for (const [key, errorMsg] of Object.entries(response.data.errors)) {
                            const li = $('<li></li>');
                            li.text(errorMsg);
                            ul.append(li);
                        }

                        // Append the list to the alert box
                        alertDiv.append(ul);

                        // Append the alert box to the alerts container
                        $('#alerts').append(alertDiv);
                    } else {

                    }

                },
                error: function (jXHR, textStatus, errorThrown) {
                    console.error("Error", errorThrown);

                }
            }
        );


    }



    //Flag of Promo Code Status
    let promoApplied = false;
    function applyPromoCode() {
        $.ajax({
            url: "<?=ROOT?>/Payment/applyPromo",
            type: "POST",
            data: $('#form1').serialize(),
            success: function (response) {
                if (promoApplied) {
                    // If promo code is already applied, return early
                    return;
                }
                if (response.data && response.data["discount"] > 0) {
                    // Mark promo code as applied
                    promoApplied = true;
                    //Lock the input box
                    document.getElementById("voucher").readOnly = true;

                    // Disable the Apply Promo Code button
                    $('#applyPromoButton').prop('disabled', true);

                    // Show successful alert
                    $('#alertPromo').empty(); // Clear previous alerts
                    const alertDivPromo = $('<div class="alert alert-success alert-dismissible fade show" role="alert"></div>');
                    alertDivPromo.text('Promo code has been applied.');
                    const closeButton = $('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
                    alertDivPromo.append(closeButton);
                    $('#alertPromo').append(alertDivPromo);

                    // Apply result
                    document.getElementById("discount-amt").innerHTML = "RM " + response.data["discount"].toFixed(2);
                    document.getElementById("pcode-no").innerHTML = response.data["promoCode"];

                    // Get the final price and update
                    const finalamt = parseFloat(document.getElementById("alltotal").innerHTML);
                    var newPrice = finalamt - response.data["discount"]; // Use the actual discount value
                    document.getElementById("alltotal").innerHTML = newPrice.toFixed(2);

                } else {
                    $('#alertPromo').empty(); // Clear previous alerts
                    // If the voucher is invalid
                    const alertDivPromo = $('<div class="alert alert-warning alert-dismissible fade show" role="alert"></div>');
                    alertDivPromo.text('Promo code used or invalid.');
                    const closeButton = $('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
                    alertDivPromo.append(closeButton);
                    $('#alertPromo').append(alertDivPromo);

                    document.getElementById("discount-amt").innerHTML = "-";
                    document.getElementById("pcode-no").innerHTML = "-";

                    // Get the final price and update
                    document.getElementById("alltotal").innerHTML = <?php if (isset($data)) { echo number_format($data["amount"]["finalPrice"], 2); } ?>;

                    promoApplied = false
                    document.getElementById("voucher").readOnly = false
                }
            },
            error: function (jXHR, textStatus, errorThrown) {
                console.error("Error", errorThrown);
            }
        });
    }

</script>

</body>

</html>