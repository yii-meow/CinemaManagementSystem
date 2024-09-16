<?php

namespace App\controllers;

use App\models\Cinema;
use App\core\Controller;
use App\core\Database;

class CinemaManagement
{
    use Controller;

    private $entityManager;
    private $cinemaRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->cinemaRepository = $this->entityManager->getRepository(Cinema::class);
    }

    public function index()
    {
        $cinemaEntities = $this->cinemaRepository->getCinemaHallNumber();

        $cinemas = array_map(function ($cinema) {
            return [
                'cinemaId' => $cinema["cinemaId"],
                'name' => $cinema["name"],
                'city' => $cinema['city'],
                'state' => $cinema["state"],
                'openingHours' => formatOpeningHours($cinema["openingHours"]),
                'hallCount' => $cinema["hallCount"]
            ];
        }, $cinemaEntities);

        $data['cinemas'] = $cinemas;
        $this->view('Admin/Cinema/CinemaManagement', $data);
    }

    public function getCinemaHallOfMovie($hallType, $startingTime, $movieId)
    {
        // need to define in cinema repository
//        $results = $this->cinemaRepository->getCinemaHallOfMovie($hallType, $startingTime, $movieId);
        // Process results...
    }

    public function addCinema()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $address = $_POST['address'] ?? '';
            $city = $_POST['city'] ?? '';
            $state = $_POST['state'] ?? '';
            $openingHours = $_POST['openingHours'] ?? '';

            if (empty($name) || empty($address) || empty($city) || empty($state) || empty($openingHours)) {
                echo 'Please fill in all required fields.';
                exit();
            } else {
                // Create a new Cinema entity
                $cinema = new Cinema();

                // Set the properties based on the POST data
                $cinema->setName($name);
                $cinema->setAddress($address);
                $cinema->setCity($city);
                $cinema->setState($state);
                $cinema->setOpeningHours($openingHours);

                // Persist the entity
                $this->entityManager->persist($cinema);

                try {
                    // Flush changes to the database
                    $this->entityManager->flush();
                    jsonResponse(['success' => true, 'message' => 'Cinema added successfully']);
                } catch (\Exception $e) {
                    // Log the error (you should implement proper error logging)
                    error_log($e->getMessage());
                    jsonResponse(['success' => false, 'message' => 'An error occurred while adding the cinema']);
                }
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Invalid request method']);
        }
    }
}