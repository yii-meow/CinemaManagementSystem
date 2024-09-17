<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Cinema;
use App\models\CinemaHall;

class CinemaDetails
{
    use Controller;

    private $entityManager;
    private $cinemaRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->cinemaRepository = $this->entityManager->getRepository(Cinema::class);
        $this->cinemaHallRepository = $this->entityManager->getRepository(CinemaHall::class);
    }

    public function index()
    {
        $cinemaId = isset($_GET['id']) ? $_GET['id'] : null;

        if ($cinemaId === null || !is_numeric($cinemaId)) {
            // Handle error - perhaps redirect or show an error message
            echo "Invalid or missing cinema ID";
            return;
        }

        $cinema = $this->cinemaRepository->find($cinemaId);

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

        $nextHallName = $this->cinemaHallRepository->getNextHallName($cinemaId);
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
                $cinema = $this->cinemaRepository->find($cinemaId);
                if (!$cinema) {
                    jsonResponse(['success' => false, 'message' => 'Invalid cinema']);
                    return;
                }
                $cinemaHall = new CinemaHall();
                $cinemaHall->setHallName($hallName);
                $cinemaHall->setCapacity((int)$capacity);
                $cinemaHall->setHallType($hallType);
                $cinemaHall->setCinema($cinema);
                $this->entityManager->persist($cinemaHall);
                $this->entityManager->flush();
                jsonResponse(['success' => true, 'message' => 'Cinema hall added successfully']);
            } catch (\Exception $e) {
                jsonResponse(['success' => false, 'message' => 'An error occurred while adding the cinema hall']);
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    public function editCinema(){
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            jsonResponse(['success' => false, 'message' => "here!"]);

            $putData = file_get_contents("php://input");

            // Decode the JSON data
            $cinemaData = json_decode($putData, true);

            if ($cinemaData === null && json_last_error() !== JSON_ERROR_NONE) {
                // Handle JSON decoding error
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
                exit;
            }

            $name = $cinemaData['name'] ?? '';
            $address = $cinemaData['address'] ?? '';
            $city = $cinemaData['city'] ?? '';
            $state = $cinemaData['state'] ?? '';
            $openingHours = $cinemaData['openingHours'] ?? '';
            $cinemaId = $cinemaData["cinemaId"];

            $cinema = new Cinema();
            $cinema->setName($name);
            $cinema->setAddress($address);
            $cinema->setCity($city);
            $cinema->setState($state);
            $cinema->setOpeningHours($openingHours);

            $cinemaHall = $this->cinemaHallRepository->findByCinemaId($cinemaId);

            jsonResponse(['success' => false, 'message' => $cinemaHall]);
        }else{

        }
    }
}