<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;


use App\core\Encryption;
use App\models\Cinema;
use App\models\Movie;
use App\models\MovieSchedule;
use App\models\CinemaHall;
use App\models\TicketPricing;
use App\models\User;
use App\models\UserReward;
use App\Strategy\PaymentStrategyContext;

class Payment
{
    use Controller;

    private $entityManager;
    private $movieRepository;
    private $movieScheduleRepository;
    private $cinemaHallRepository;
    private $cinemaRepository;
    private $ticketPricingRepository;
    private $userRewardRepository;
    private $userRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        //Get the Repository
        $this->movieRepository = $this->entityManager->getRepository(Movie::class);
        $this->movieScheduleRepository = $this->entityManager->getRepository(MovieSchedule::class);
        $this->cinemaHallRepository = $this->entityManager->getRepository(CinemaHall::class);
        $this->cinemaRepository = $this->entityManager->getRepository(Cinema::class);
        $this->ticketPricingRepository = $this->entityManager->getRepository(TicketPricing::class);
        $this->userRewardRepository = $this->entityManager->getRepository(UserReward::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    public function decryptParam($param, $decryption)
    {
        return isset($_GET[$param]) ? $decryption->decrypt($_GET[$param], $decryption->getKey()) : '';
    }

    public function index()
    {
        $decryption = new Encryption();

        $queryString = [
            'scheduleId' => (int)$this->decryptParam('scheduleId', $decryption),
            'seats' => $this->decryptParam('seats', $decryption),
            'date' => $this->decryptParam('date', $decryption),
            'hid' => (int)$this->decryptParam('hid', $decryption),
        ];

        //Get Movie ID
        $movieId = (int)$_SESSION['movieId'];

        //Get Movie Details
        $movieData = [];
        $movieObj = $this->movieRepository->find((int)$movieId);
        if ($movieObj) {
            $movieData = [
                "movieId" => $movieObj->getMovieId(),
                "title" => $movieObj->getTitle(),
                "photo" => $movieObj->getPhoto(),
                "trailerLink" => $movieObj->getTrailerLink(),
                "duration" => $movieObj->getDuration(),
                "catagory" => $movieObj->getCatagory(),
                "releaseDate" => $movieObj->getReleaseDate(),
                "language" => $movieObj->getLanguage(),
                "subtitles" => $movieObj->getSubtitles(),
                "director" => $movieObj->getDirector(),
                "casts" => $movieObj->getCasts(),
                "description" => $movieObj->getDescription(),
                "classification" => $movieObj->getClassification(),
                "status" => $movieObj->getStatus(),
            ];
        }


        //Get Hall Details
        $hallData = [];
        $hallObj = $this->cinemaHallRepository->find((int)$queryString["hid"]);
        if ($hallObj) {
            $cinemaObj = $hallObj->getCinema();

            $hallData = [
                //Get Hall Info
                "hallName" => $hallObj->getHallName(),
                "hallType" => $hallObj->getHallType(),
                //Get Cinema Name
                "cinema" => $cinemaObj ? [
                    "cinemaName" => $cinemaObj->getName(),
                ] : null,
            ];

        }


        //Price Calculation
        $amount = $this->calculateTotalPrice((string)$hallData["hallType"], (string)$queryString["date"], (string)$queryString["seats"]);

        //Preparing data to pass
        $data = [
            "movie" => $movieData,
            "qs" => $queryString,
            "amount" => $amount,
            "cinemaHall" => $hallData,
        ];

        // Close the EntityManager Database Connection after operations are done
        $this->entityManager->close();

        $this->view("Customer/Payment/Payment", $data);
    }


    //PROCESS PAYMENT (After Submitting Form)
    public function processPayment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Store error message
            $errors = [];
            $userName = "";

            //Get Payment Method from FORM
            $selectedPaymentMethod = isset($_POST['payoption']) ? $this->test_input((string)$_POST['payoption']) : null;

            //User Details
            $firstName = $this->test_input((string)$_POST['fName']);
            $lastName = $this->test_input((string)$_POST['lName']);
            $email = $this->test_input((string)$_POST['email']);

            //VALIDATION
            //Basic Information
            $validPaymentMethods = ['cash', 'card', 'wallet'];
            if (empty($selectedPaymentMethod)) {
                $errors["paymentMethod"] = "Payment method is empty.";
            } else if (!in_array($selectedPaymentMethod, $validPaymentMethods)) {
                $errors["paymentMethod"] = "Payment Method {$selectedPaymentMethod} is not valid";
            }

            //FirstName
            if (empty($firstName)) {
                $errors["firstName"] = "First name cannot be empty.";
            } elseif (!preg_match("/^[a-zA-Z]+$/", $firstName)) {
                $errors["firstName"] = "First name must contain only alphabetic characters.";
            }

            //LastName
            if (empty($lastName)) {
                $errors["lastName"] = "Last name cannot be empty.";
            } elseif (!preg_match("/^[a-zA-Z]+$/", $lastName)) {
                $errors["lastName"] = "Last name must contain only alphabetic characters.";
            }

            //Combine firstname lastname
            if (!empty($firstName) && !empty($lastName)) {
                $userName = $firstName . " " . $lastName;
            }

            //Email
            if (empty($email)) {
                $errors["email"] = "Email address cannot be empty.";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Invalid email address.";
            }

            //If Card is chosen
            $cardType = "";
            $cardNumber = "";
            $expiryDate = "";
            $cvv = "";
            if ($selectedPaymentMethod === 'card') {
                $cardType = $this->test_input((string)$_POST['cardType']);
                $cardNumber = $this->test_input((string)$_POST['cardNumber']);
                $expiryDate = $this->test_input((string)$_POST['expiryDate']);
                $cvv = $this->test_input((string)$_POST['cvv']);

                if (empty($cardNumber)) {
                    $errors["cardNumber"] = "Card number is required.";
                } elseif (!preg_match('/^[0-9]{16}$/', $cardNumber)) {
                    $errors["cardNumber"] = "Invalid card number. Must be 16 digits.";
                }

                if (empty($expiryDate)) {
                    $errors["expiryDate"] = "Expiry date is required.";
                } elseif (!preg_match('/^(0[1-9]|1[0-2])\/[0-9]{2}$/', $expiryDate)) {
                    $errors["expiryDate"] = "Invalid expiry date. Format should be MM/YY.";
                }

                if (empty($cvv)) {
                    $errors["cvv"] = "CVV is required.";
                } elseif (!preg_match('/^[0-9]{3,4}$/', $cvv)) {
                    $errors["cvv"] = "Invalid CVV. Must be 3 or 4 digits.";
                }
            }

            // If E-wallet is chosen
            $walletPhone = "";
            $walletPassword = "";
            if ($selectedPaymentMethod === 'wallet') {
                $walletPhone = $this->test_input((string)$_POST['phone']);
                $walletPassword = $this->test_input((string)$_POST['txtEwalletPassword']);

                if (empty($walletPhone)) {
                    $errors["walletPhone"] = "E-Wallet phone number is required.";
                } elseif (!preg_match('/^01[0-9]{8,9}$/', $walletPhone)) {
                    $errors["walletPhone"] = "Invalid E-Wallet phone number.";
                }

                if (empty($walletPassword)) {
                    $errors["walletPassword"] = "E-Wallet password is required.";
                } elseif (strlen($walletPassword) < 6) {
                    $errors["walletPassword"] = "E-Wallet password must be at least 6 characters long.";
                }
            }

            // If there are errors, re-render the view with errors and form data
            if (!empty($errors)) {
                $data = [
                    "errors" => $errors,
                ];

                //Pass back Error result to view via AJAX
                header('Content-Type: application/json');
                echo json_encode(['data' => $data]);
                exit;
            } else {

                ///////DESIGN PATTERN - STRATEGY
                //Preparing Data To Pass
                $amount = (double)$_POST['finalPrice'] ?? '';
                $custInfo = (string)$userName . "|" . $email;
                $hallId = (int)$_POST['hallId'] ?? '';
                $seats = (string)$_POST['seatsNo'] ?? '';
                $userId = 6;  //Test ID
                //$userId = (int)$_SESSION['userId'];
                $scheduleId = (int)$_POST['scheduleId'] ?? '';
                $date = (string)$_POST['selectedDateTime'];
                //paymentMethod got already => $selectedPaymentMethod

                $paymentData = [
                    //Basic info
                    "amount" => $amount,
                    "custInfo" => $custInfo,
                    "hallId" => $hallId,
                    "seats" => $seats,
                    "userId" => $userId,
                    "scheduleId" => $scheduleId,
                    "date" => $date,
                    "paymentMethod" => $selectedPaymentMethod,
                    //Card
                    "cardType" => $cardType,
                    "cardNumber" => $cardNumber,
                    "expiryDate" => $expiryDate,
                    "cvv" => $cvv,
                    //E-wallet
                    "walletPhone" => $walletPhone,
                    "walletPassword" => $walletPassword,
                ];

                //Initialize PaymentStrategyContext with the selected payment method and data
                $paymentContext = new PaymentStrategyContext($selectedPaymentMethod);
                $result = $paymentContext->pay($paymentData);  //Process the payment


                //If the Concrete Strategy returns ticketId
                if ($result) {
                    //Process Query String Encryption
                    $encryption = new Encryption();
                    $encryptedTicketId = $encryption->encrypt($result, $encryption->getKey());

                    //Successful Adding Update Coin and PromoCode Use
                    $this->updateUserCoin((int)$userId, (int)$amount);

                    $promoCodePass = $_POST["promoCodePass"] ?? '';
                    if ($promoCodePass != "-") {
                        // Update promo code status
                        $this->updatePromoCodeStatus((int)$userId, (int)$promoCodePass);
                    }

                    //Success, return encrypted ticketId
                    header('Content-Type: application/json');
                    echo json_encode(['redirect' => $encryptedTicketId]);
                    exit();

                } else {
                    //Else, return an indicator of error
                    header('Content-Type: application/json');
                    echo json_encode(['redirect' => "Err"]);
                    exit();
                }

            }

        } else {
            // Not a POST request
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }

    }


    //Update Coin - Correct
    function updateUserCoin($userId, $amount)
    {
        $coinEarned = (int)($amount * 0.05);
        $user = $this->userRepository->find((int)$userId);

        //Update
        if ($user) {
            $userCoin = (int)$user->getCoins();
            $newCoin = $userCoin + $coinEarned;
            $user->setCoins($newCoin);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
    }

    //Update Promo Code Status
    function updatePromoCodeStatus(int $userId, int $promoCode)
    {
        $promoCodeEntity = $this->entityManager->getRepository(UserReward::class)->findOneBy(['promoCode' => $promoCode]);

        if ($promoCodeEntity) {
            // Update the status
            $promoCodeEntity->setRewardCondition('used'); // Assuming 'status' is a field in your PromoCode entity

            // Persist changes
            $this->entityManager->persist($promoCodeEntity);
            $this->entityManager->flush();
        }
    }


    //Get amount
    public function calculateTotalPrice($hallType, $date, $seatNo): array
    {
        //Get All The Pricing Details
        $pricingModel = [];
        $result = $this->ticketPricingRepository->findAll();
        if ($result) {
            $pricingModel = [
                "IMAX" => $result[0]->getBaseTicketIMAX(),
                "DELUXE" => $result[0]->getBaseTicketDeluxe(),
                "ATMOS" => $result[0]->getBaseTicketAtmos(),
                "BENIE" => $result[0]->getBaseTicketBenie(),
                "WeekdayBefore12" => $result[0]->getTimeBasedWeekdayBefore12(),
                "WeekdayAfter12" => $result[0]->getTimeBasedWeekdayAfter12(),
                "Weekend" => $result[0]->getTimeBasedWeekend(),
                "Midnight" => $result[0]->getTimeBasedMidnight(),
                "commission" => $result[0]->getCommissionFee(),
            ];
        }


        //Get Base Price
        $hallPrice = 0.0;
        switch ($hallType) {
            case "IMAX":
                $hallPrice = $pricingModel["IMAX"];
                break;
            case "DELUXE":
                $hallPrice = $pricingModel["DELUXE"];
                break;
            case "BENIE":
                $hallPrice = $pricingModel["BENIE"];
                break;
            case "ATMOS":
                $hallPrice = $pricingModel["ATMOS"];
                break;
            default:
        }


        //Adjust Price According to Time => Adjusted Price is the Final Price for each ticket
        $dateTime = new \DateTime($date, new \DateTimeZone('Asia/Kuala_Lumpur'));
        $adjustedPrice = $hallPrice;
        //Check Weekend
        $isWeekend = (in_array($dateTime->format('N'), [6, 7])); // 6 = Saturday, 7 = Sunday
        //Check Before 12AM
        if ($dateTime->format('H:i') < "12:00" && !$isWeekend) {
            // Weekday before 12 PM (-20%)
            $adjustedPrice -= $hallPrice * ($pricingModel["WeekdayBefore12"] / 100);
        } elseif ($dateTime->format('H:i') >= "23:00" && !$isWeekend) {
            // Midnight after 11 PM (-10%)
            $adjustedPrice -= $hallPrice * ($pricingModel["Midnight"] / 100);
        } elseif ($isWeekend) {
            // Weekend (+10%)
            $adjustedPrice += $hallPrice * ($pricingModel["Weekend"] / 100);
        }


        //START COMPUTING
        //Multiply the Number of ticket => Get the Single ticket price from adjustedPrice
        $seats = explode("|", $seatNo);
        $seatCount = count($seats);
        $totalTicketPrice = $seatCount * $adjustedPrice;


        //Calculate Commission Price (1.5%)
        $commissionFee = $totalTicketPrice * ($pricingModel["commission"] / 100);


        //Calculate the SST (6%)
        $sst = $totalTicketPrice * 0.06;


        //Final Price Result
        return [
            'totalTicketPrice' => $totalTicketPrice,
            'commissionFee' => $commissionFee,
            'sst' => $sst,
            'finalPrice' => $totalTicketPrice + $commissionFee + $sst,
        ];
    }


    public function applyPromo()
    {
        //Check Promo Code Discount
        $promoCode = $this->test_input((int)$_POST['promoCode'] ?? '');
        $discount = $this->checkPromoCodeForThatUser((int)$promoCode);

        $data = [
            "promoCode" => $promoCode,
            "discount" => $discount,
        ];

        //Pass back Error result to view via AJAX
        header('Content-Type: application/json');
        echo json_encode(['data' => $data]);
        exit;
    }

    public
    function checkPromoCodeForThatUser($promoCode): float
    {
        //Test User ID
        //$userId = $_SESSION['userId'];
        $userId = 6;

        $userRewardObj = $this->userRewardRepository->findPromoCodeUserOwn((int)$userId, (int)$promoCode);

        if ($userRewardObj) {
            return 20.00;
        } else {
            return 0.0;
        }
    }


    //converts special characters into HTML entities => prevents attackers from exploiting the code by injecting HTML or Javascript code (Cross-site Scripting attacks) in forms.
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}