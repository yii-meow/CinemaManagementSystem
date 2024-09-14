<?php
namespace App\models;
use Doctrine\ORM\Mapping as ORM;
class MovieSchedule
{
    public function getMovieScheduleDate($movieID){

        $query = "
                SELECT 
                    DATE(startingTime) AS scheduleDate,
                    startingTime,
                    MIN(movieScheduleId) AS movieScheduleId,
                    CONVERT_TZ(NOW(), '+00:00', '+08:00') AS currentTime
                FROM 
                    MovieSchedule
                WHERE 
                    movieId = :movieId
                    AND startingTime > CONVERT_TZ(NOW(), '+00:00', '+08:00')
                GROUP BY 
                    scheduleDate
                ORDER BY 
                    scheduleDate;
                ";

        $result = $this->query($query, $movieID);
        return $result;
    }



}