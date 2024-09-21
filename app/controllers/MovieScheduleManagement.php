<?php

namespace App\controllers;

use App\core\Controller;
use App\Facade\CinemaFacade;

class MovieScheduleManagement
{
    use Controller;

    private $cinemaFacade;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
    }

    public function index()
    {
        if (isset($_SESSION['admin']) && $_SESSION['admin']['role'] === 'SuperAdmin') {
            $hallId = isset($_GET['hallId']) ? $_GET['hallId'] : null;
            $scheduleData = $this->cinemaFacade->getHallScheduleData($hallId);

            return $this->view('Admin/Hall/HallMovieSchedule', $scheduleData);
        } else {
            $this->view("Admin/403PermissionDenied");
        }
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