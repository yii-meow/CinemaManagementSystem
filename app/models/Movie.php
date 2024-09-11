<?php

class Movie
{
    //All access to database query put here

    //Query = Get movie by id
    public function getMovieByMovieID($sqlParameters){
        $result = Database::query("SELECT * FROM Movie WHERE movieId = ?", [$sqlParameters]);
        return $result;
    }

}

?>