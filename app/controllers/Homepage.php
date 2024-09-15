<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Cinema;
use App\models\MovieSchedule;

class Homepage
{
    use Controller;

    private $entityManager;
    private $cinemaRepository;
    private $movieScheduleRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->cinemaRepository = $this->entityManager->getRepository(Cinema::class);
        $this->movieScheduleRepository = $this->entityManager->getRepository(MovieSchedule::class);
    }

    public function index()
    {
        $cinemas = $this->cinemaRepository->findAll();
        $showtimes = $this->movieScheduleRepository->findMovieSchedule();
        //Please do use this only at the end of the operations

        $this->view('Customer/Movie/Homepage',[
            'cinemas' => $cinemas,
            'moviesWithGroupedSchedules' => $showtimes
                ]
        );
    }
}