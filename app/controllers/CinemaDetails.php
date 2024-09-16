<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Cinema;

class CinemaDetails
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
}