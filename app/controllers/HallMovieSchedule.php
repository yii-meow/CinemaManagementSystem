<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\MovieSchedule;

class HallMovieSchedule
{
    use Controller;

    private $entityManager;
    private $cinemaRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->movieScheduleRepository = $this->entityManager->getRepository(MovieSchedule::class);
    }

    public function index()
    {
        $hallId = isset($_GET['hallId']) ? $_GET['hallId'] : null;

        $showtimes = $this->movieScheduleRepository->findUpcomingSchedulesByHall($hallId);
        $groupedSchedules = [];
        foreach ($showtimes as $showtime) {
            $date = $showtime->getStartingTime()->format('Y-m-d');
            $movieId = $showtime->getMovie()->getMovieId();
            $groupedSchedules[$date][$movieId]['movie'] = $showtime->getMovie();
            $groupedSchedules[$date][$movieId]['times'][] = $showtime->getStartingTime();
        }

        return $this->view('Admin/Hall/HallMovieSchedule', [
            'hall' => $hallId,
            'groupedSchedules' => $groupedSchedules
        ]);
    }
}