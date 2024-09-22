<?php
/**
 * @author Chong Yik Soon
 */

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

    public function addMovieSchedule()
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
                $result = $this->cinemaFacade->addMovieSchedule($cinemaHallId, $movieId, $startingTime);
                if ($result === true) {
                    jsonResponse(['success' => true, 'message' => 'Movie schedule added successfully']);
                } else {
                    jsonResponse(['success' => false, 'message' => $result]);
                }
            } catch (\Exception $e) {
                jsonResponse(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    public function updateMovieSchedule()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            jsonResponse(['success' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        $scheduleId = $_POST['scheduleId'] ?? '';
        $startingTime = $_POST['startingTime'] ?? '';

        if (empty($scheduleId) || empty($startingTime)) {
            jsonResponse(['success' => false, 'message' => 'Please fill in all required fields.']);
            return;
        }

        try {
            $newDateTime = new \DateTime($startingTime);
            $this->cinemaFacade->updateMovieSchedule($scheduleId, $newDateTime);
            jsonResponse(['success' => true, 'message' => 'Movie schedule updated successfully']);
        } catch (\Exception $e) {
            jsonResponse(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function removeMovieSchedule($scheduleId = null)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            jsonResponse(['success' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        if (!$scheduleId) {
            jsonResponse(['success' => false, 'message' => 'Schedule ID is required']);
            return;
        }

        try {
            $result = $this->cinemaFacade->removeMovieSchedule($scheduleId);
            if ($result) {
                jsonResponse(['success' => true, 'message' => 'Movie schedule removed successfully']);
            } else {
                jsonResponse(['success' => false, 'message' => 'Failed to remove movie schedule']);
            }
        } catch (\Exception $e) {
            jsonResponse(['success' => false, 'message' => 'Error removing movie schedule: ' . $e->getMessage()]);
        }
    }
}