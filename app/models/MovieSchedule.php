<?php
class MovieSchedule
{
    public function getMovieScheduleDate($movieID){
        $query = "SELECT DATE(startingTime) AS scheduleDate,
                  startingTime,
                   MIN(movieScheduleId) AS movieScheduleId
                    FROM MovieSchedule
                    WHERE movieId = :movieId
                      AND startingTime >= NOW()
                    GROUP BY scheduleDate
                    ORDER BY scheduleDate";

        $result = $this->query($query, $movieID);
        return $result;
    }



}