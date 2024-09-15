<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Cinema;
use App\models\Movie;
use App\models\MovieSchedule;

class Homepage
{
    use Controller;

    private $entityManager;
    private $cinemaRepository;
    private $movieScheduleRepository;
    private $movieRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        $this->cinemaRepository = $this->entityManager->getRepository(Cinema::class);
        $this->movieScheduleRepository = $this->entityManager->getRepository(MovieSchedule::class);
        $this->movieRepository = $this->entityManager->getRepository(Movie::class);
    }

    public function index()
    {
        $cinemas = $this->cinemaRepository->findAll();
        $showtimes = $this->movieScheduleRepository->findMovieSchedule();
        $comingSoonMovies = $this->movieRepository->findComingSoonMovies();
        //Please do use this only at the end of the operations

        $this->view('Customer/Movie/Homepage',[
            'cinemas' => $cinemas,
            'moviesWithGroupedSchedules' => $showtimes,
                "comingSoonMovies" => $comingSoonMovies
                ]
        );
    }
}