<?php

namespace App\repositories;

use App\models\MovieSchedule;
use Doctrine\ORM\EntityRepository;
use DoctrineExtensions\Query\Mysql\Date;


class MovieScheduleRepository extends EntityRepository
{
    public function findByMovieScheduleDate($movieId)
    {
        $today = new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur'));

        $results = $this->createQueryBuilder("ms")
            ->select('ms.startingTime', 'ms.movieScheduleId')
            ->where('ms.movie = :movie')
            ->andWhere('ms.startingTime >= :today')
            ->setParameter('movie', $movieId)
            ->setParameter('today', $today->format('Y-m-d H:i:s'))
            ->orderBy('ms.startingTime', 'ASC')
            ->getQuery()
            ->getResult();

        // Filter distinct startingTimes
        $distinctResults = [];
        foreach ($results as $result) {
            $startingTimeKey = $result['startingTime']->format('Y-m-d');
            if (!isset($distinctResults[$startingTimeKey])) {
                $distinctResults[$startingTimeKey] = $result;
            }
        }

        return array_values($distinctResults);
    }



//        $today = new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur'));
//
//        $results = $this->createQueryBuilder("ms")
//            ->select('ms.startingTime', 'ms.movieScheduleId')
//            ->where('ms.movie = :movie')
//            ->andWhere('ms.startingTime >= :today')
//            ->setParameter('movie', $movieId)
//            ->setParameter('today', $today->format('Y-m-d H:i:s'))
//            ->orderBy('ms.startingTime', 'ASC')
//            ->getQuery()
//            ->getResult();
//
//        // Filter distinct startingTimes
//        $distinctResults = [];
//        foreach ($results as $result) {
//            $startingTimeKey = $result['startingTime']->format('Y-m-d');
//            if (!isset($distinctResults[$startingTimeKey])) {
//                $distinctResults[$startingTimeKey] = $result;
//            }
//        }
//
//        return array_values($distinctResults);
//    }



    public function findCinemaHallOfMovie($movieId, $selectedDate)
    {
        $date = new \DateTime($selectedDate, new \DateTimeZone('Asia/Kuala_Lumpur'));
        $qb = $this->createQueryBuilder('ms')
            ->select('ch.hallType', 'ch.hallName', 'ch.capacity', 'ch.hallId', 'ms.startingTime')
            ->join('ms.cinemaHall', 'ch')
            ->where('ms.movie = :movieId')
            ->andWhere('ms.startingTime >= :date_start')
            ->andWhere('ms.startingTime <= :date_end')
            ->setParameter('movieId', $movieId)
            ->setParameter('date_start', $date->format('Y-m-d 00:00:00'))  //Get a specific date
            ->setParameter('date_end',   $date->format('Y-m-d 23:59:59'));  //Get a specific date

        return $qb->getQuery()->getResult();

    }
}