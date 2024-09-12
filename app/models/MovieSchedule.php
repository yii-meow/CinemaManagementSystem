<?php
class MovieSchedule
{
    use Database;
    public function getMovieScheduleDate($movieID){
        $query = "SELECT startingTime, MIN(movieScheduleId) AS movieScheduleId
                    FROM MovieSchedule
                    WHERE movieId = :movieId
                    AND startingTime >= NOW()
                    GROUP BY startingTime
                    ORDER BY startingTime;";
        $result = $this->query($query, $movieID);
        return $result;
    }



}