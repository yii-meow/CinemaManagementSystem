<?php

require_once '../core/Database.php';
class Movie
{
    //Get movie by id
    public function getMovieByMovieID($sqlParameters){
        $result = Database::query("SELECT * FROM Movie WHERE movieId = ?", [$sqlParameters]);
        return $result;
    }

}

?>