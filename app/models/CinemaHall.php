<?php

class CinemaHall
{
    use Database;

    public function getCinemaHallOfMovie($hallId){
        $query = "SELECT * FROM CinemaHall WHERE hallId = :hallId";
        $result = $this->query($query, $hallId);
        return $result;
    }
}