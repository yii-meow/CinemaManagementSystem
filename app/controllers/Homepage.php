<?php
/**
 * @author Chong Yik Soon
 */
namespace App\controllers;

use App\core\Controller;
use App\Facade\CinemaFacade;

class Homepage
{
    use Controller;

    private $cinemaFacade;

    public function __construct()
    {
        $this->cinemaFacade = new CinemaFacade();
    }

    public function index()
    {
        $cinemas = $this->cinemaFacade->getAllCinemas();
        $showtimes = $this->cinemaFacade->getMovieSchedules();
        $comingSoonMovies = $this->cinemaFacade->getComingSoonMovies();
        $topFiveMovies = $this->cinemaFacade->getTopFiveMovies();

        $this->view('Customer/Movie/Homepage', [
            'cinemas' => $cinemas,
            'moviesWithGroupedSchedules' => $showtimes,
            "comingSoonMovies" => $comingSoonMovies,
            "topFiveMovies" => $topFiveMovies
        ]);
    }
}