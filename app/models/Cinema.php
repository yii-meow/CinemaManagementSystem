<?php

class Cinema
{
    use Database;

    public function getCinemaHallOfMovie($arr){
        $query = "SELECT c.cinemaId, c.name AS cinemaName, c.address, c.city, c.state, c.openingHours,
                   ch.hallId, ch.hallName, ch.hallType,
                   ms.startingTime,
                   m.movieId, m.title AS movieTitle, m.duration, m.language, m.description
                    FROM Cinema c
                    JOIN CinemaHall ch ON c.cinemaId = ch.cinemaId
                    JOIN MovieSchedule ms ON ch.hallId = ms.cinemaHallId
                    JOIN Movie m ON ms.movieId = m.movieId
                    WHERE ch.hallType = :hallType
                    AND ms.startingTime > NOW()
                    AND m.movieId = :movieId
                    AND DATE(ms.startingTime) = :startingTime";

        $result = $this->query($query, $arr);

        return $result;
    }

}