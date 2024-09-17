<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;


use App\models\Cinema;
use App\models\Movie;
use App\models\MovieSchedule;
use App\models\CinemaHall;

class SeatSelection
{
    use Controller;

    private $entityManager;
    private $movieRepository;
    private $movieScheduleRepository;
    private $cinemaHallRepository;
    private $cinemaRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        //Get the Repository
        $this->movieRepository = $this->entityManager->getRepository(Movie::class);
        $this->movieScheduleRepository = $this->entityManager->getRepository(MovieSchedule::class);
        $this->cinemaHallRepository = $this->entityManager->getRepository(CinemaHall::class);
        $this->cinemaRepository = $this->entityManager->getRepository(Cinema::class);
    }

    public function index()
    {

        //MovieID
        $movieId = (int) $_SESSION['movieId'];

        //Query String Details
        $queryString["cinema"] = (string) $_GET["cin"];
        $queryString["experience"] = (string) $_GET["exp"];
        $queryString["date"] = (string) $_GET["date"];
        $queryString["hallId"] = (int) $_GET["hid"];
        $queryString["cinemaId"] = (int) $_GET["cid"];
        $queryString["movieScheduleId"] = (int) $_GET["sce"];
        $queryString["hallName"] = (string) $_GET["hname"];



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
        $hallObj = $this->cinemaRepository->findCinemaHallDetails((int) $queryString["cinemaId"], (string) $queryString["date"]);

        if ($hallObj) {
            $hallData = [
                "hallId" => $hallObj[0]["hallId"],
                "capacity" => $hallObj[0]["capacity"],
            ];
        }


        //Preparing data to pass
        $data = [
            "movie" => $movieData,
            "hall" => $hallObj,
            "qs" => $queryString,
        ];

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
            $listOfSelectedSeat = $_POST['listOfSeat'] ?? '';

            // Check if the user selected seats
            if ($listOfSelectedSeat) {
                // If seats are selected, prepare the data to pass to the Payment view
                header("Location:". ROOT . " /Payment?seats=". $listOfSelectedSeat . "&scheduleId=". $scheduleId . "&exp=" . $experience . "&date=" . $date . "&hid=" . $hallId . "&cn=" . $cinemaName . "&hn=" . $hallName);
            } else {
                if(isset($_REQUEST["destination"])){
                    header("Location: {$_REQUEST["destination"]}");
                }
            }

        }


    }


}