<?php

class SeatSelection
{
    use Controller;

    public function index()
    {

        //MovieID
        $movieID = $_SESSION['movieId'];

        //Query String Details
        $queryString["cinema"] = $_GET["cin"];
        $queryString["experience"] = $_GET["exp"];
        $queryString["date"] = $_GET["date"];
        $queryString["hallId"] = $_GET["hid"];

        //Movie Details
        $movieData = [];
        $modalMovie = new Movie();
        $arrMovie["movieId"] = $movieID;
        $movieResult = $modalMovie->getMovieByMovieID($arrMovie);
        if($movieResult){
            $movieData = $movieResult[0];
        }

        //Seat Details
        $hallData = [];
        $modalHall = new CinemaHall();
        $arrHall["movieId"] = $movieID;
        $arrHall["startingTime"] = $_GET["date"];
        $hallResult = $modalHall->getCinemaHallCapacity($arrHall);
        if($hallResult){
            $hallData = $hallResult[0];
        }

        //Preparing data to pass
        $data = [
            "movie" => $movieData,
            "qs" => $queryString,
            "hall" => $hallData,
        ];

        show($data);

        $this->view('Customer/Selection/SeatSelection', $data);
    }
}