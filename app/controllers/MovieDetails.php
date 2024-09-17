<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Database;
use App\models\Movie;

class MovieDetails
{

    use Controller;

    private $entityManager;
    private $movieRepository;

    public function __construct()
    {
        $this->entityManager = Database::getEntityManager();
        //Get the Repository
        $this->movieRepository = $this->entityManager->getRepository(Movie::class);
    }

    public function index()
    {
        //Gather SQL parameters
        $movieID = 1; //test id

        //Get a specific record
        $movieResult = $this->movieRepository->find($movieID);
        $data = []; // this is associate array, to store the retrieved data
        if ($movieResult) {
            $data = [
                //key     => value
                "movieId" => $movieResult->getMovieId(),
                "title" => $movieResult->getTitle(),
                "duration" => $movieResult->getDuration(),
                "photo" => $movieResult->getPhoto(),
                "trailerLink" => $movieResult->getTrailerLink(),
                "category" => $movieResult->getCatagory(),
                "releaseDate" => $movieResult->getReleaseDate() ? $movieResult->getReleaseDate()->format('Y-m-d H:i:s') : null,
                "language" => $movieResult->getLanguage(),
                "subtitles" => $movieResult->getSubtitles(),
                "director" => $movieResult->getDirector(),
                "casts" => $movieResult->getCasts(),
                "description" => $movieResult->getDescription(),
                "classification" => $movieResult->getClassification(),
                "status" => $movieResult->getStatus(),
            ];
        }

        //Route to the destinaiton page, with passing data from the Model
        $this->view('Customer/Movie/MovieDetails', $data); // the method from Controller

    }
}
