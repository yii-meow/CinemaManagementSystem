<?php

namespace App\controllers;

use App\core\Controller;
use App\Facade\CinemaFacade;

class HallMovieSchedule
{
    use Controller;

    private $cinemaFacade;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
    }

    public function index()
    {
        $hallId = isset($_GET['hallId']) ? $_GET['hallId'] : null;
        $cinemaHall = $this->cinemaFacade->getCinemaHallDetails($hallId);

        $cinemaInformation = null;
        if ($cinemaHall && $cinemaHall->getCinema()) {
            $cinemaInformation = [
                'name' => $cinemaHall->getCinema()->getName(),
                'hallName' => $cinemaHall->getHallName(),
                'hallId' => $cinemaHall->getHallId()
            ];
        }

        $showtimes = $this->cinemaFacade->getUpcomingSchedulesByHall($hallId);
        $groupedSchedules = [];
        foreach ($showtimes as $showtime) {
            $date = $showtime->getStartingTime()->format('Y-m-d');
            $movieId = $showtime->getMovie()->getMovieId();
            $groupedSchedules[$date][$movieId]['movie'] = $showtime->getMovie();
            $groupedSchedules[$date][$movieId]['times'][] = $showtime->getStartingTime();
        }

        $movies = $this->cinemaFacade->getAllMovies();
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
                jsonResponse(['success' => false, 'message' => 'Please fill in all required fields.']);
                return;
            }

            try {
                $this->cinemaFacade->addMovieSchedule($cinemaHallId, $movieId, $startingTime);
                jsonResponse(['success' => true, 'message' => 'Movie schedule added successfully']);
            } catch (\Exception $e) {
                jsonResponse(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Invalid request method']);
        }
    }
}