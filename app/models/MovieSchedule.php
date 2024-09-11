<?php
class MovieSchedule
{
    use Database;
    public function getMovieScheduleDate($movieID){
        $query = "SELECT * FROM MovieSchedule " .
            "WHERE movieId = :movieId " .
            "AND startingTime >= now() ";
        $result = $this->query($query, $movieID);
        return $result;
    }



}