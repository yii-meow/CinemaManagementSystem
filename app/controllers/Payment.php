<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;


use App\models\Cinema;
use App\models\Movie;
use App\models\MovieSchedule;
use App\models\CinemaHall;
use App\models\TicketPricing;
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
    }

    public function index()
    {
        //Get Query String Values
        $schedule = (int) $_GET['scheduleId'] ?? '';
        $queryString['scheduleId'] = $schedule;

        $seats = (string) $_GET['seats'] ?? '';
        $queryString['seats'] = $seats;

        $experience = (string) $_GET['exp'] ?? '';
        $queryString['exp'] = $experience;

        $date = (string) $_GET['date'] ?? '';
        $queryString['date'] = $date;

        $hallId = (int) $_GET['hid'] ?? '';
        $queryString['hid'] = $hallId;

        $cinemaName = (string) $_GET['cn'] ?? '';
        $queryString['cn'] = $cinemaName;

        $hallName = (string) $_GET['hn'] ?? '';
        $queryString['hn'] = $hallName;


        //Get Movie ID
        $movieId = (int) $_SESSION['movieId'];

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


        //Price Calculation
        $amount = $this->calculateTotalPrice((string)$experience,(string)$date, (string)$seats);

        //Preparing data to pass
        $data = [
            "movie" => $movieData,
            "qs" => $queryString,
            "amount" => $amount,
        ];

        //show($data);

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
            //$selectedPaymentMethod = $this->test_input($_POST['payoption']);
            $selectedPaymentMethod = isset($_POST['payoption']) ? $this->test_input((string)$_POST['payoption']) : null;

            //User Details
            $firstName = $this->test_input((string)$_POST['fName']);
            $lastName = $this->test_input((string)$_POST['lName']);
            $email = $this->test_input((string)$_POST['email']);
            $phone = $this->test_input((string)$_POST['phone']);



            //VALIDATION
            //Payment Method
            $validPaymentMethods = ['cash', 'tng', 'grab'];
            if (empty($selectedPaymentMethod)) {
                $errors["paymentMethod"] = "Payment method is empty.";
            } else if (!in_array($selectedPaymentMethod, $validPaymentMethods)) {
                $errors["paymentMethod"] = "Payment Method ${$selectedPaymentMethod} is not valid";
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

            //Phone
            if (empty($phone)) {
                $errors["phone"] = "Phone number cannot be empty.";
            } else if (!preg_match('/^01[0-9]{8,9}$/', $phone)) {
                $errors["phone"] = "Invalid phone number.";
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
                //PROCESSING - if no errors
                //Get Total Price ($amount)
                $amount = $_POST['finalPrice'] ?? '';  //Returned Value



                ///////DESIGN PATTERN - STRATEGY
                //Initialize PaymentStrategyContext with the selected payment method
                $paymentContext = new PaymentStrategyContext($selectedPaymentMethod);

                //Process the payment
                $result = $paymentContext->pay($amount);

                if ($result) {
                    // Payment was successful
                    echo "Payment successful";

                    // Redirect or handle successful payment here
                } else {
                    // Payment failed
                    echo "Payment failed";

                    // Redirect or handle failed payment here
                }
            }


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
        //return $totalTicketPrice + $commissionFee + $sst - $discount;
        return [
            'totalTicketPrice' => $totalTicketPrice,
            'commissionFee' => $commissionFee,
            'sst' => $sst,
            'finalPrice' => $totalTicketPrice + $commissionFee + $sst,
        ];
    }


    public function applyPromo(){
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

    public function checkPromoCodeForThatUser($promoCode): float
    {
        //Test User ID
        //$userId = $_SESSION['userId'];
        $userId = 6;

        $userRewardObj = $this->userRewardRepository->findPromoCodeUserOwn((int)$userId, (int)$promoCode);

        if($userRewardObj){
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