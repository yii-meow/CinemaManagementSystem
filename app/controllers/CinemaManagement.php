<?php

namespace App\controllers;

use App\core\Controller;
use App\Facade\CinemaFacade;

class CinemaManagement
{
    use Controller;

    private $cinemaFacade;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
    }

    public function index()
    {
        $cinemaEntities = $this->cinemaFacade->getAllCinemas();

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
        // This method needs to be implemented in CinemaFacade
        $results = $this->cinemaFacade->getCinemaHallOfMovie($hallType, $startingTime, $movieId);
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
                jsonResponse(['success' => false, 'message' => 'Please fill in all required fields.']);
                return;
            }

            try {
                $this->cinemaFacade->addCinema($name, $address, $city, $state, $openingHours);
                jsonResponse(['success' => true, 'message' => 'Cinema added successfully']);
            } catch (\Exception $e) {
                jsonResponse(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Invalid request method']);
        }
    }
}