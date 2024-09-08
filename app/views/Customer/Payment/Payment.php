<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../../../../public/css/Payment.css" rel="stylesheet" />

    <title>Payment</title>
    <link rel="icon" type="image/x-icon" href="../../../../public/images/icon.png" />
</head>

<body>
    <div class="all-container">
        <!-- Payment side -->
        <div class="left-box">
            <div class="logo">
                <img src="../../../../public/images/alternativeIcon.png" draggable="false" style="border-radius: 5px;" width="300" ID="imgLogo" />
            </div>
            <div class="cont">

                <span class="small-title">Payment Methods
                </span>
                <!-- Payment method -->
                <div class="supported-methods">

                    <div class="pay">
                        <input type="radio" class="btn-check" name="pay-option" id="pay1" autocomplete="off">
                        <label data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Cash"
                            class="btn btn-outline-danger" for="pay1">
                            <img src="../../../../public/images/cash.png" draggable="false" />&nbsp;Cash
                        </label>
                    </div>

                    <div class="pay">
                        <input type="radio" class="btn-check" name="pay-option" id="pay2" autocomplete="off">
                        <label data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Touch 'n Go e-Wallet"
                            class="btn btn-outline-danger" for="pay2">
                            <img src="../../../../public/images/tng.png" draggable="false"/>&nbsp;Touch 'n Go e-Wallet
                        </label>
                    </div>

                </div>
                <!-- End select payment method -->
            </div>
            <form class="formdetail" autocomplete="off">
                <div class="fill">
                    <div class="title">
                        Booking Information
                    </div>
                    <div class="box2">
                        <div class="name">
                            <div class="form-floating fname">
                                <input type="text" id="txtFirstName" class="form-control" placeholder="First Name"
                                    name="fName" autocomplete="off" />
                                <label for="txtFirstName">First Name</label>
                            </div>
                            <div class="form-floating lname">
                                <input type="text" id="txtLastName" class="form-control" placeholder="Last Name"
                                    name="lName" autocomplete="off" />
                                <label for="txtLastName">Last Name</label>
                            </div>
                        </div>
                        <div class="form-floating email">
                            <input type="email" id="txtEmail" class="form-control" placeholder="Email" />
                            <label for="txtEmail">Email</label>
                        </div>
                        <div class="form-floating phone">
                            <input type="tel" id="txtPhone" class="form-control" placeholder="Phone" />
                            <label for="txtPhone">Phone</label>
                        </div>
                        <div class="askVoucher">
                            <div class="form-check check-box">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" style="color: #f03351; text-decoration: underline;" for="flexCheckDefault">
                                    I HAVE A VOUCHER
                                </label>
                            </div>
                            <div style="display: none;" class="form-floating voucher" id="voucherbox">
                                <input type="tel" id="voucher" class="form-control" placeholder="Voucher Number" />
                                <label for="txtPhone">Voucher Number</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                    <button type="button" class="btn btn-danger">Checkout</button>
                </div>
            </form>
        </div>

        <!-- Info Side -->
        <div class="right-box">
            <input type="hidden" id="hdnID" value="" />
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
                                <span>BOCCHI THE ROCK! Recap Part 1BOCCHI THE ROCK! Recap Part 1BOCCHI THE ROCK! Recap Part 1BOCCHI THE ROCK! Recap Part 1BOCCHI THE ROCK! Recap Part 1BOCCHI THE ROCK! Recap Part 1BOCCHI THE ROCK! Recap Part 1</span>
                            </td>
                        </tr>
                        <tr class="detail">
                            <td class="title-d">Date & Time :
                            </td>
                            <td class="answer">
                                <span>Mon 29 July, 10:30AM</span>
                            </td>
                        </tr>
                        <tr class="detail">
                            <td class="title-d">Experience :
                            </td>
                            <td class="answer">
                                <span>Deluxe</span>
                            </td>
                        </tr>
                        <tr class="detail">
                            <td class="title-d">Cinema :
                            </td>
                            <td class="answer">
                                <span>PAVILION BUKIT JALIL</span>
                            </td>
                        </tr>
                        <tr class="detail">
                            <td class="title-d">Hall :
                            </td>
                            <td class="answer">
                                <span>11</span>
                            </td>
                        </tr>
                        <tr class="detail">
                            <td class="title-d">Seats :
                            </td>
                            <td class="answer">
                                <span>A3, A4, A5</span>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
            <!--End of An Item-->
            <hr />
            <!-- Final payment info -->
            <table class="payment">
                <tr class="subtotal">
                    <td class="tt t2">Total :
                    </td>
                    <td style="text-align: left">
                        <span id="lblTotal">RM 22.60</span>
                    </td>
                </tr>
                <tr class="discount">
                    <td class="tt t2">Voucher Discount :
                    </td>
                    <td style="text-align: left">
                        <span id="discount-amt">RM 10.00</span>
                    </td>
                </tr>
                <tr class="tax">
                    <td class="tt t2">SST Tax (6%) :
                    </td>
                    <td style="text-align: left">
                        <span id="tax">RM 2.40</span>
                    </td>
                </tr>
            </table>

            <hr />

            <div class="all-total">
                <div class="tt">Overall Total :</div>
                <div>
                    <span id="alltotal">RM 15.00</span>
                </div>
            </div>
        </div>


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
                }
            })

        </script>

        </form>
</body>

</html>