<?php

namespace App\repositories;

use App\models\CinemaHall;
use App\models\Cinema;
use App\models\MovieSchedule;
use Doctrine\ORM\EntityRepository;

class CinemaHallRepository extends EntityRepository
{
    public function findCinemaHallOfMovie($movieId, $selectedDate)
    {
//        return $this->createQueryBuilder('c')
//            ->select('ms.startingTime, c.hallId, c.hallName, c.capacity, c.hallType, c.cinema')
//            ->innerJoin('App\models\MovieSchedule', 'ms', 'WITH', 'ms.cinemaHall = c.hallId')
//            ->innerJoin('App\models\Movie', 'm', 'WITH', 'm.movieId = ms.movie')
//            ->where('m.movieId = :movieId')
//            ->andWhere('ms.startingTime = :selectedDate')
//            ->setParameter('movieId', $movieId)
//            ->setParameter('selectedDate', $selectedDate)
//            ->orderBy('ms.startingTime', 'ASC')
//            ->getQuery()
//            ->getResult();

        return $this->createQueryBuilder('c')
            ->select('c.hallId')
            ->getQuery()
            ->getResult();
    }
}