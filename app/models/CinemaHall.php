<?php

class CinemaHall
{
    use Database;
    public function getCinemaHallOfMovie($arr){
        $query = "WITH RankedHalls AS (
                        SELECT 
                            ms.startingTime, 
                            c.hallId, 
                            c.hallName, 
                            c.capacity, 
                            c.hallType, 
                            c.cinemaId,
                            ROW_NUMBER() OVER (PARTITION BY c.hallType ORDER BY ms.startingTime) AS rn
                        FROM Movie m
                        JOIN MovieSchedule ms ON m.movieId = ms.movieId
                        JOIN CinemaHall c ON ms.cinemaHallId = c.hallId
                        WHERE m.movieId = :movieId
                          AND ms.startingTime = :startingTime
                    )
                    SELECT 
                        startingTime, hallId, hallName, capacity, hallType, cinemaId
                    FROM RankedHalls
                    WHERE rn = 1
                    ORDER BY startingTime;";

        $result = $this->query($query, $arr);

        return $result;
    }

    //Get capacity of the hall
    public function getCinemaHallCapacity($arr){
        $query = "SELECT ch.hallId, ch.hallName, ch.capacity, ch.hallType, c.cinemaId, c.name AS cinemaName, ms.startingTime 
                    FROM Cinema c 
                    JOIN CinemaHall ch ON c.cinemaId = ch.cinemaId 
                    JOIN MovieSchedule ms ON ch.hallId = ms.cinemaHallId 
                    WHERE c.cinemaId = :cinemaId 
                    AND ms.startingTime = :startingTime;";

        $result = $this->query($query, $arr);

        return $result;
    }


}

