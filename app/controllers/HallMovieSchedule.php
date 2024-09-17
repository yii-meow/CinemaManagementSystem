<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\CinemaHall;
use App\models\Movie;
use App\models\MovieSchedule;

class HallMovieSchedule
{
    use Controller;

    private $entityManager;
    private $cinemaRepository;
    private $movieRepository;
    private $movieScheduleRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->movieScheduleRepository = $this->entityManager->getRepository(MovieSchedule::class);
        $this->movieRepository = $this->entityManager->getRepository(Movie::class);
        $this->cinemaHallRepository = $this->entityManager->getRepository(CinemaHall::class);
    }

    public function index()
    {
        $hallId = isset($_GET['hallId']) ? $_GET['hallId'] : null;
        $cinemaHall = $this->cinemaHallRepository->findByHallId($hallId);

        $cinemaInformation = null;
        if ($cinemaHall && $cinemaHall->getCinema()) {
            $cinemaInformation = [
                'name' => $cinemaHall->getCinema()->getName(),
                'hallName' => $cinemaHall->getHallName(),
                'hallId' => $cinemaHall->getHallId()
            ];
        }

        $showtimes = $this->movieScheduleRepository->findUpcomingSchedulesByHall($hallId);
        $groupedSchedules = [];
        foreach ($showtimes as $showtime) {
            $date = $showtime->getStartingTime()->format('Y-m-d');
            $movieId = $showtime->getMovie()->getMovieId();
            $groupedSchedules[$date][$movieId]['movie'] = $showtime->getMovie();
            $groupedSchedules[$date][$movieId]['times'][] = $showtime->getStartingTime();
        }

        $movies = $this->movieRepository->findAll();
        $movieArray = array_map(function ($movie) {
            return [
                'id' => $movie->getMovieId(),
                'title' => $movie->getTitle()
            ];
        }, $movies);

        return $this->view('Admin/Hall/HallMovieSchedule', [
            'groupedSchedules' => $groupedSchedules,
            'movies' => $movieArray,
            'cinemaInformation' => $cinemaInformation
        ]);
    }

    public function addHallMovieSchedule()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cinemaHallId = $_POST['cinemaHallId'] ?? '';
            $movieId = $_POST['movieId'] ?? '';
            $startingTime = $_POST['startingTime'] ?? '';

            if (empty($cinemaHallId) || empty($movieId) || empty($startingTime)) {
                echo 'Please fill in all required fields.';
                exit();
            } else {
                try {
                    // Fetch the related entities
                    $movie = $this->movieRepository->find($movieId);
                    $cinemaHall = $this->cinemaHallRepository->find($cinemaHallId);
                    if (!$movie || !$cinemaHall) {
                        jsonResponse(['success' => false, 'message' => 'Invalid movie or cinema hall.']);
                        return;
                    }

                    // Create a new MovieSchedule entity
                    $movieSchedule = new MovieSchedule();

                    // Set the properties based on the POST data
                    $movieSchedule->setStartingTime(new \DateTime($startingTime));
                    $movieSchedule->setMovie($movie);
                    $movieSchedule->setCinemaHall($cinemaHall);

                    // Persist the entity
                    $this->entityManager->persist($movieSchedule);

                    // Flush changes to the database
                    $this->entityManager->flush();
                    jsonResponse(['success' => true, 'message' => 'Cinema added successfully']);
                } catch (\Exception $e) {
                    jsonResponse(['success' => false, 'message' => 'An error occurred while adding the movie schedule']);
                }
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Invalid request method']);
        }
    }
}