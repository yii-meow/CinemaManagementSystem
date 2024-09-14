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
        $this->movieRepository = $this->entityManager->getRepository(Movie::class);
    }

    public function index()
    {
        //Gather SQL parameters
        $movieID = 1; //test id
        // predefined method by doctrine
        $result = $this->movieRepository->findByMovieId($movieID);

        // Initialize Model in order to use the model
//        $model = new Movie();
//        $arr["movieId"] = $movieID;
//        $result = $model->getMovieByMovieID($arr);
//

        $data = [];
        if ($result) {
            $data = [
                "movieId" => $result[0]->getMovieId(),
                "title" => $result[0]->getTitle(),
                "duration" => $result[0]->getDuration(),
                "photo" => $result[0]->getPhoto(),
                "trailerLink" => $result[0]->getTrailerLink(),
                "category" => $result[0]->getCatagory(),
                "releaseDate" => $result[0]->getReleaseDate(),
                "language" => $result[0]->getLanguage(),
                "subtitles" => $result[0]->getSubtitles(),
                "director" => $result[0]->getDirector(),
                "casts" => $result[0]->getCasts(),
                "description" => $result[0]->getDescription(),
                "classification" => $result[0]->getClassification(),
                "status" => $result[0]->getStatus()
            ];
        }

        //Route to the destinaiton page, with passing data from the Model
        $this->view('Customer/Movie/MovieDetails', $data);
    }
}
