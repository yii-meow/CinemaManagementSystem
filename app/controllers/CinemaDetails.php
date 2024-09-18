<?php

namespace App\controllers;

use App\core\Controller;
use App\Facade\CinemaFacade;

class CinemaDetails
{
    use Controller;

    private $cinemaFacade;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
    }

    public function index()
    {
        $cinemaId = isset($_GET['id']) ? $_GET['id'] : null;

        if ($cinemaId === null || !is_numeric($cinemaId)) {
            echo "Invalid or missing cinema ID";
            return;
        }

        $cinema = $this->cinemaFacade->getCinemaDetails($cinemaId);

        if (!$cinema) {
            echo "Cinema not found";
            return;
        }

        $cinemaHalls = $cinema->getCinemaHalls();

        $this->view('Admin/Cinema/CinemaDetails', ['cinema' => $cinema, 'cinemaHalls' => $cinemaHalls]);
    }

    public function getNextHallName()
    {
        $cinemaId = $_GET['cinemaId'] ?? null;
        if (!$cinemaId) {
            jsonResponse(['success' => false, 'message' => 'Cinema ID is required']);
            return;
        }

        $nextHallName = $this->cinemaFacade->getNextHallName($cinemaId);
        jsonResponse(['success' => true, 'nextHallName' => $nextHallName]);
    }

    public function addCinemaHall()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cinemaId = $_POST['cinemaId'] ?? '';
            $hallName = $_POST['hallName'] ?? '';
            $capacity = $_POST['capacity'] ?? '';
            $hallType = $_POST['hallType'] ?? '';

            if (empty($cinemaId) || empty($hallName) || empty($capacity) || empty($hallType)) {
                jsonResponse(['success' => false, 'message' => 'All fields are required']);
                return;
            }

            try {
                $this->cinemaFacade->addCinemaHall($cinemaId, $hallName, $capacity, $hallType);
                jsonResponse(['success' => true, 'message' => 'Cinema hall added successfully']);
            } catch (\Exception $e) {
                jsonResponse(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    public function editCinema()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $putData = json_decode(file_get_contents("php://input"), true);

            if ($putData === null && json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
                exit;
            }

            $cinemaId = $putData["cinemaId"] ?? null;

            if (!$cinemaId) {
                jsonResponse(['success' => false, 'message' => 'Cinema ID is required']);
                return;
            }

            try {
                $this->cinemaFacade->updateCinema($cinemaId, $putData);
                jsonResponse(['success' => true, 'message' => 'Cinema updated successfully']);
            } catch (\Exception $e) {
                jsonResponse(['success' => false, 'message' => 'Error updating cinema: ' . $e->getMessage()]);
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Method Not Allowed']);
        }
    }
}