<?php

class MovieDetails
{
    use Controller;

    public function index()
    {
        //Gather SQL parameters
        $movieID = 3; //test id

        // Initialize Model in order to use the model
        $model = new Movie();
        $arr["movieId"] = $movieID;
        $result = $model->getMovieByMovieID($arr);

        show($result);

        //Route to the destinaiton page, with passing data from the Model
        $this->view('Customer/Movie/MovieDetails', $result);
    }
}
