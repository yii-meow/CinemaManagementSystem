<?php

namespace App\controllers;

use App\models\Cinema;
use App\core\Controller;
use App\core\Database;

use App\Facade\CinemaFacade;

class CinemaManagement
{
    use Controller;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
    }

    public function index()
    {
        $cinemas = $this->cinemaFacade->getAllCinemas();
        // Process the cinemas data as before
        $this->view('Admin/Cinema/CinemaManagement', ['cinemas' => $cinemas]);
    }

    public function addCinema()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $cinema = $this->cinemaFacade->addCinema(
                    $_POST['name'],
                    $_POST['address'],
                    $_POST['city'],
                    $_POST['state'],
                    $_POST['openingHours']
                );
                jsonResponse(['success' => true, 'message' => 'Cinema added successfully']);
            } catch (\Exception $e) {
                jsonResponse(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            jsonResponse(['success' => false, 'message' => 'Invalid request method']);
        }
    }
}