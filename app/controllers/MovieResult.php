<?php

namespace App\controllers;

use App\core\Controller;
use App\Facade\CinemaFacade;

class MovieResult
{
    use Controller;

    private $cinemaFacade;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
    }

    public function index()
    {
        $search = $_GET['search'] ?? '';
        $category = $_GET['category'] ?? '';

        $moviesWithGroupedSchedules = $this->cinemaFacade->searchMovies($search, $category);
        return $this->view("Customer/Movie/MovieResult", [
            'moviesWithGroupedSchedules' => $moviesWithGroupedSchedules,
        ]);
    }
}