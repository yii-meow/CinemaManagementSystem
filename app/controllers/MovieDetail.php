<?php

class MovieDetail extends Controller
{

    // Index of the home page (localhost/home(/index))
    public function index($param1 = '', $param2 = '', $param3 = '')
    {
        //Gather SQL parameters
        $movieID = 3; //test id

        // Initialize Test model
        $movie = $this->model('Movie');

        // Call function from the model
        $movieData = $movie->getMovieByMovieID($movieID);

        $this->view('Customer/Movie/MovieDetail', ['data' => $movieData]);
    }

}
?>
