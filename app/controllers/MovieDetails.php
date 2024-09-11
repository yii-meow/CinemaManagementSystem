<?php

class MovieDetails
{
    use Controller;

    public function index()
    {
        //Gather SQL parameters
        $movieID = 2; //test id

        // Initialize Model in order to use the model
        $model = new Movie();
        $arr["movieId"] = $movieID;
        $result = $model->getMovieByMovieID($arr);

        $data = [];
        if($result){
            $data = [
                "movieId" => $result[0]->movieId,
                "title" => $result[0]->title,
                "duration" => $result[0]->duration,
                "photo" => $result[0]->photo,
                "trailerLink" => $result[0]->trailerLink,
                "category" => $result[0]->catagory,
                "releaseDate" => $result[0]->releaseDate,
                "language" => $result[0]->language,
                "subtitles" => $result[0]->subtitles,
                "director" => $result[0]->director,
                "casts" => $result[0]->casts,
                "description" => $result[0]->description,
                "classification" => $result[0]->classification,
                "status" => $result[0]->status
            ];
        }

        //Route to the destinaiton page, with passing data from the Model
        $this->view('Customer/Movie/MovieDetails', $data);
    }
}
