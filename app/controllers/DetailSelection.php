<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;


use App\models\Cinema;
use App\models\Movie;
use App\models\MovieSchedule;
use App\models\CinemaHall;
use function Symfony\Component\String\s;

class DetailSelection
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
        //Get query string value
        $movieId = (int) $_GET['mid']; //obtain the query string from in MovieDetails.view.php
        $_SESSION['movieId'] = $movieId;

        //A Database Operation
        $resultMovie = $this->movieRepository->find((int)$movieId);
        $dataMovieDetails = [];
        if ($resultMovie) {
            $dataMovieDetails = [
                "movieId" => $resultMovie->getMovieId(),
                "title" => $resultMovie->getTitle(),
                "duration" => $resultMovie->getDuration(),
                "photo" => $resultMovie->getPhoto(),
            ];
        }


        //Get Movie Schedule Date and Time
        $dataSchedule = [];
        $resultSchedule = $this->movieScheduleRepository->findByMovieScheduleDate((int)$movieId);

        if ($resultSchedule) {
            foreach ($resultSchedule as $schedule) {
                $dataSchedule[] = $schedule;
            }
        }

        // Combines multiple $data from different queries
        $data = [
            'movies' => $dataMovieDetails,
            'schedules' => $dataSchedule,
        ];

//        show($data);

        //Please do use this only at the end of the operations
        $this->view('Customer/Selection/DetailSelection', $data);
    }



    //If the system cannot find the specified method in view, it will call the default one which is index() specified in App.php
    //Method 2
    public function fetchHallExperienceOfTheMovieDate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve data from POST request
            $selectedDate = $_POST['selectedDate'] ?? '';

            //Doctrine Operation
            $result = $this->movieScheduleRepository->findCinemaHallOfMovie((int)$_SESSION['movieId'], (string)$selectedDate);

            //Pass result back to view
            if($result) {
                // Respond with JSON
                header('Content-Type: application/json');
                echo json_encode(['data' => $result]);
                exit;
            }

        }
    }


    public function fetchCinemaAndTime()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve data from POST request
            $SelectedValues = (string) $_POST['options-exp'] ?? '';
            $explodedValue = explode("|", $SelectedValues);
            $selectedExperience = (string) $explodedValue[0];
            $selectedDate = (string) $explodedValue[1];

            $result = $this->cinemaRepository->findCinemaHallOfMovie((string)$selectedExperience , (string)$selectedDate, (int)$_SESSION['movieId']);

            //Pass result back to view
            if($result) {
                // Respond with JSON
                header('Content-Type: application/json');
                echo json_encode(['data' => $result]);
                exit;
            }
        }
    }
}
