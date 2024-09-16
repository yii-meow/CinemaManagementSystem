<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;


use App\models\Cinema;
use App\models\Movie;
use App\models\MovieSchedule;
use App\models\CinemaHall;

class Payment
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
        //Get Query String Values
        $schedule = $_GET['scheduleId'] ?? '';
        $queryString['scheduleId'] = $schedule;

        $seats = $_GET['seats'] ?? '';
        $queryString['seats'] = $seats;

        $experience = $_GET['exp'] ?? '';
        $queryString['exp'] = $experience;

        $date = $_GET['date'] ?? '';
        $queryString['date'] = $date;

        $hallId = $_GET['hid'] ?? '';
        $queryString['hid'] = $hallId;

        $cinemaName = $_GET['cn'] ?? '';
        $queryString['cn'] = $cinemaName;

        $hallName = $_GET['hn'] ?? '';
        $queryString['hn'] = $hallName;




        //Get Movie ID
        $movieId = $_SESSION['movieId'];

        //Get Movie Details
        $movieData = [];
        $movieObj = $this->movieRepository->find($movieId);
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


        //Preparing data to pass
        $data = [
            "movie" => $movieData,
            "qs" => $queryString,
        ];



        $this->view("Customer/Payment/Payment", $data);
    }
}