<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;


use App\core\Encryption;
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

        // Check if userId is set in the session
        if (!isset($_SESSION['userId'])) {
            $this->view('Customer/User/Login');
            exit();
        }


        //Get query string value
        $movieIdEncrypted = (string)$_GET['mid'];

        //Decrypt the query string values
        $decryption = new Encryption();
        $movieId = $decryption->decrypt($movieIdEncrypted, $decryption->getKey());

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

        // Close the EntityManager Database Connection after operations are done
        $this->entityManager->close();

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
            if ($result) {
                // Respond with JSON
                header('Content-Type: application/json');
                echo json_encode(['data' => $result]);
                exit;
            }

            // Close the EntityManager Database Connection after operations are done
            $this->entityManager->close();
        }
    }


    public function fetchCinemaAndTime()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve data from POST request
            $SelectedValues = (string)$_POST['options-exp'] ?? '';
            $explodedValue = explode("|", $SelectedValues);
            $selectedExperience = (string)$explodedValue[0];
            $selectedDate = (string)$explodedValue[1];

            $result = $this->cinemaRepository->findCinemaHallOfMovie((string)$selectedExperience, (string)$selectedDate, (int)$_SESSION['movieId']);

            //Pass result back to view
            if ($result) {
                // Respond with JSON
                header('Content-Type: application/json');
                echo json_encode(['data' => $result]);
                exit;
            }

            // Close the EntityManager Database Connection after operations are done
            $this->entityManager->close();
        }
    }


    public function encryptQueryStringValue()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve JSON data from POST request
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['data'])) {
                // Get the combined string
                $combinedString = $data['data'];

                // Explode the combined string into individual values
                $values = explode('|', $combinedString);

                if (count($values) !== 7) {
                    echo json_encode(['success' => false, 'message' => 'Invalid number of values']);
                    exit;
                }

                // Assign individual values to variables
                list($cinema, $experience, $hallName, $dateTime, $hallId, $cinemaId, $scheduleId) = $values;

                // Initialize Encryption class
                $encryption = new Encryption();

                // Encrypt each value
                $encryptedData = [
                    'cinema' => $encryption->encrypt($cinema, $encryption->getKey()),
                    'experience' => $encryption->encrypt($experience, $encryption->getKey()),
                    'hallName' => $encryption->encrypt($hallName, $encryption->getKey()),
                    'dateTime' => $encryption->encrypt($dateTime, $encryption->getKey()),
                    'hallId' => $encryption->encrypt($hallId, $encryption->getKey()),
                    'cinemaId' => $encryption->encrypt($cinemaId, $encryption->getKey()),
                    'scheduleId' => $encryption->encrypt($scheduleId, $encryption->getKey())
                ];

                // Construct the redirect URL with encrypted values
                $redirectUrl = '/SeatSelection?' .
                    'cin=' . urlencode($encryptedData['cinema']) .
                    '&exp=' . urlencode($encryptedData['experience']) .
                    '&date=' . urlencode($encryptedData['dateTime']) .
                    '&hid=' . urlencode($encryptedData['hallId']) .
                    '&cid=' . urlencode($encryptedData['cinemaId']) .
                    '&sce=' . urlencode($encryptedData['scheduleId']) .
                    '&hname=' . urlencode($encryptedData['hallName']);

                // Respond with JSON
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'redirectUrl' => $redirectUrl]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No data provided']);
            }
            exit;
        }
    }

}
