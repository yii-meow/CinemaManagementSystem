<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\CinemaHall;

class HallConfiguration
{
    use Controller;

    private $entityManager;
    private $cinemaHallRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->cinemaHallRepository = $this->entityManager->getRepository(CinemaHall::class);
    }

    public function index()
    {
        $hallId = isset($_GET['hallId']) ? $_GET['hallId'] : null;
        $cinemaHall = $this->cinemaHallRepository->findByHallId($hallId);

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
            $hall = $this->cinemaHallRepository->findByHallId($putData['hallId']);
            if (!$hall) {
                jsonResponse(['success' => false, 'message' => 'Hall not found']);
                return;
            }

            $updated = false;

            // Update hall type if provided
            if (isset($putData['hallType'])) {
                $hallType = $putData['hallType'];
                $validTypes = ['IMAX', 'DELUXE', 'ATMOS', 'BENIE'];
                if (!in_array($hallType, $validTypes)) {
                    jsonResponse(['success' => false, 'message' => 'Invalid hall type']);
                    return;
                }
                $hall->setHallType($hallType);
                $updated = true;
            }

            // Update capacity if provided
            if (isset($putData['capacity'])) {
                $capacity = intval($putData['capacity']);
                if ($capacity <= 0) {
                    jsonResponse(['success' => false, 'message' => 'Capacity must be a positive number']);
                    return;
                }
                $hall->setCapacity($capacity);
                $updated = true;
            }

            // Add more properties here as needed
            if ($updated) {
                $this->entityManager->flush();
                jsonResponse(['success' => true, 'message' => 'Cinema hall updated successfully']);
            } else {
                jsonResponse(['success' => false, 'message' => 'No valid properties provided for update']);
            }
        } catch (\Exception $e) {
            jsonResponse(['success' => false, 'message' => 'Error updating cinema hall: ' . $e->getMessage()]);
        }
    }
}