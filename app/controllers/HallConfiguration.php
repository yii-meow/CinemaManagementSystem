<?php

namespace App\controllers;

use App\core\Controller;
use App\Facade\CinemaFacade;

class HallConfiguration
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
                'cinemaName' => $cinemaHall->getCinema()->getName(),
                'hallName' => $cinemaHall->getHallName(),
                'hallId' => $cinemaHall->getHallId(),
                'capacity' => $cinemaHall->getCapacity(),
                'hallType' => $cinemaHall->getHallType()
            ];
        }
        return $this->view("Admin/Hall/HallConfiguration", ['cinemaInformation' => $cinemaInformation]);
    }

    public function updateHall()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            jsonResponse(['success' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        $putData = json_decode(file_get_contents("php://input"), true);

        if (empty($putData)) {
            jsonResponse(['success' => false, 'message' => 'No data provided for update']);
            return;
        }

        try {
            $this->cinemaFacade->updateCinemaHall($putData['hallId'], $putData);
            jsonResponse(['success' => true, 'message' => 'Cinema hall updated successfully']);
        } catch (\Exception $e) {
            jsonResponse(['success' => false, 'message' => 'Error updating cinema hall: ' . $e->getMessage()]);
        }
    }
}