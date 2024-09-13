<?php

namespace App\controllers;
use App\models\Cinema;
use App\core\Controller;
use App\core\Database;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

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
        $cinemas = $this->cinemaRepository->findAll();
        $data['cinemas'] = $cinemas;
        $this->view('Admin/Cinema/CinemaManagement', $data);
    }


    public function getCinemaHallOfMovie($hallType, $startingTime, $movieId)
    {
        $results = $this->cinemaRepository->getCinemaHallOfMovie($hallType, $startingTime, $movieId);
        // Process results...
    }
}