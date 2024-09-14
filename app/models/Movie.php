<?php

class Movie {
// 1 model = 1 db table
    use Database;

    //Get movie by id
    public function getMovieByMovieID($sqlParameters){
        $query = "SELECT * FROM Movie WHERE movieId = :movieId";
        $result = $this->query($query, $sqlParameters); // your retrieved result from db
        return $result;
    }

}

?>