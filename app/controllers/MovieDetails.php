<?php

class MovieDetails
{
    use Controller;
    public function index()
    {
        $this->view('Customer/Movie/MovieDetails');
//        //Gather SQL parameters
//        $movieID = 3; //test id
//
//        // Initialize Model in order to use the model
//        $movie = $this->model('Movie');
//
//        // Call function from the model, with the returned results
//        // Inside the method (), we can pass in the parameters for SQL query, according to the '?' sequence in the method in the Model
//        $movieData = $movie->getMovieByMovieID($movieID);
//
//        //Route to the destinaiton page, with passing data from the Model
//        $this->view('Customer/Movie/MovieDetail', $movieData);
    }
}
