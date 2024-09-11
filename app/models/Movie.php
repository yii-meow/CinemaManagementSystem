<?php

class Movie {

    use Database;

    //Query = Get movie by id
    public function getMovieByMovieID($sqlParameters){
        $query = "SELECT * FROM Movie WHERE movieId = :movieId";
        $result = $this->query($query, $sqlParameters);
        return $result;
    }

}

?>