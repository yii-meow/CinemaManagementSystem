<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;


use App\core\Encryption;
use App\models\Cinema;
use App\models\Movie;
use App\models\MovieSchedule;
use App\models\CinemaHall;
use App\models\Seat;

class SeatSelection
{
    use Controller;

    private $entityManager;
    private $movieRepository;
    private $movieScheduleRepository;
    private $cinemaHallRepository;
    private $cinemaRepository;

    private $seatRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        //Get the Repository
        $this->movieRepository = $this->entityManager->getRepository(Movie::class);
        $this->movieScheduleRepository = $this->entityManager->getRepository(MovieSchedule::class);
        $this->cinemaHallRepository = $this->entityManager->getRepository(CinemaHall::class);
        $this->cinemaRepository = $this->entityManager->getRepository(Cinema::class);
        $this->seatRepository = $this->entityManager->getRepository(Seat::class);
    }

    public function index()
    {


        // Check if userId is set in the session
        if (!isset($_SESSION['userId'])) {
            $this->view('Customer/User/Login');
            exit();
        }

        //MovieID
        $movieId = (int) $_SESSION['movieId'];

        //Query String Details
        $decryption = new Encryption();

        $cinema = $decryption->decrypt((string) $_GET["cin"], $decryption->getKey());
        $experience = $decryption->decrypt((string) $_GET["exp"], $decryption->getKey());
        $date = $decryption->decrypt((string) $_GET["date"], $decryption->getKey());
        $hallId = (int) $decryption->decrypt((string) $_GET["hid"], $decryption->getKey());
        $cinemaId = (int) $decryption->decrypt((string) $_GET["cid"], $decryption->getKey());
        $movieScheduleId = (int) $decryption->decrypt((string) $_GET["sce"], $decryption->getKey());
        $hallName = $decryption->decrypt((string) $_GET["hname"], $decryption->getKey());

        //Prepare Query String Value to Display
        $queryString["cinema"] = (string) $cinema;
        $queryString["experience"] = (string) $experience;
        $queryString["date"] = (string) $date;
        $queryString["hallId"] = (string) $hallId;
        $queryString["cinemaId"] = (int) $cinemaId;
        $queryString["movieScheduleId"] = $movieScheduleId;;
        $queryString["hallName"] = (string) $hallName;



        //MovieDetails
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

        //Seat Details
        $hallData = [];
        $hallObj = $this->cinemaRepository->findCinemaHallDetails((int)$cinemaId, (string) $date);

        if ($hallObj) {
            $hallData = [
                "hallId" => $hallObj[0]["hallId"],
                "capacity" => $hallObj[0]["capacity"],
            ];
        }

        //Find Occupied Seats
        $occupiedSeat = [];
        $seats = $this->seatRepository->findAllSeatsOfTheMovieOfTheDateTime((int)$movieId, (string)$date);
        if ($seats) {
            foreach ($seats as $seat) {
                $occupiedSeat[] = $seat;
            }
        }




        //Preparing data to pass
        $data = [
            "movie" => $movieData,
            "hall" => $hallObj,
            "qs" => $queryString,
            "occupiedSeat" => $occupiedSeat,
        ];

        //show($data);

        // Close the EntityManager Database Connection after operations are done
        $this->entityManager->close();

        //Render VIew
        $this->view('Customer/Selection/SeatSelection', $data);
    }



    public function SubmitRequest()
    {
        // Initialize an empty $data array to pass to the view
        $data = [];

        // Check if the request is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Get the values from the form
            $listOfSelectedSeat = $_POST['listOfSeat'] ?? '';
            $scheduleId = $_POST['scheduleId'] ?? '';
            $cinemaName = $_POST['cinema'] ?? '';
            $experience = $_POST['experience'] ?? '';
            $date = $_POST['date'] ?? '';
            $hallId = $_POST['hallId'] ?? '';
            $hallName = $_POST['hallName'] ?? '';

            // Encrypt each parameter
            $encryption = new Encryption();

            $encryptedSeats = $encryption->encrypt($listOfSelectedSeat, $encryption->getKey());
            $encryptedScheduleId = $encryption->encrypt($scheduleId, $encryption->getKey());
            $encryptedDate = $encryption->encrypt($date, $encryption->getKey());
            $encryptedHallId = $encryption->encrypt($hallId, $encryption->getKey()); //Used to get Hall Name, Hall Experience, Cinema ID FOR NAME

            // Check if the user selected seats
            if ($listOfSelectedSeat) {
                // If seats are selected, prepare the data to pass to the Payment view
                header("Location:" . ROOT . "/Payment?seats=$encryptedSeats&scheduleId=$encryptedScheduleId&date=$encryptedDate&hid=$encryptedHallId");
            } else {
                if(isset($_REQUEST["destination"])){
                    header("Location: {$_REQUEST["destination"]}");
                }
            }


            // Close the EntityManager Database Connection after operations are done
            $this->entityManager->close();
        }


    }


}