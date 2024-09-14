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
        $cinemaEntities = $this->cinemaRepository->findAll();
        $cinemas = array_map(function ($cinema) {
            return [
                'cinemaId' => $cinema->getCinemaId(),
                'name' => $cinema->getName(),
                'address' => $cinema->getAddress(),
                'city' => $cinema->getCity(),
                'state' => $cinema->getState(),
                'openingHours' => $cinema->getOpeningHours()
            ];
        }, $cinemaEntities);

        $testingEntities = $this->cinemaRepository->findByState("Kuala Lumpur");

        $data['cinemas'] = $cinemas;
        $this->view('Admin/Cinema/CinemaManagement', $data);
    }


    public function getCinemaHallOfMovie($hallType, $startingTime, $movieId)
    {
        // need to define in cinema repository
//        $results = $this->cinemaRepository->getCinemaHallOfMovie($hallType, $startingTime, $movieId);
        // Process results...
    }
}