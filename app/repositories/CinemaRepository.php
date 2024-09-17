<?php

namespace App\repositories;

use App\models\Cinema;
use Doctrine\ORM\EntityRepository;

class CinemaRepository extends EntityRepository
{
    public function findByState(string $state)
    {
        return $this->createQueryBuilder('c')
            ->where('c.state = :state')
            ->setParameter('state', $state)
            ->getQuery()
            ->getResult();
    }

    public function findOpenCinemas()
    {
        $now = new \DateTime();
        $currentTime = $now->format('H:i');

        return $this->createQueryBuilder('c')
            ->where('c.openingHours LIKE :currentTime')
            ->setParameter('currentTime', '%' . $currentTime . '%')
            ->getQuery()
            ->getResult();
    }


    public function findCinemaHallOfMovie(string $hallType, string $startingTime, int $movieId){ //statingTime later will be converted to \DateTime

        $date = new \DateTime($startingTime);
        $qb = $this->createQueryBuilder('c')
            ->select(
                'c.cinemaId',
                'c.name AS cinemaName',
                'c.address',
                'c.city',
                'c.state',
                'c.openingHours',
                'ch.hallId',
                'ch.hallName',
                'ch.hallType',
                'ms.startingTime',
                'm.movieId',
                'm.title AS movieTitle',
                'm.duration',
                'm.language',
                'm.description',
                'ms.movieScheduleId'
            )
            ->join('c.cinemaHalls', 'ch')
            ->join('ch.movieSchedules', 'ms')
            ->join('ms.movie', 'm')
            ->where('ch.hallType = :hallType')
            ->andWhere('ms.startingTime BETWEEN :date_start AND :date_end')
            ->andWhere('m.movieId = :movieId')
            ->andWhere('ms.startingTime > :now')
            ->setParameter('hallType', $hallType)
            ->setParameter('date_start', $date->format('Y-m-d 00:00:00'))
            ->setParameter('date_end', $date->format('Y-m-d 23:59:59'))
            ->setParameter('movieId', $movieId)
            ->setParameter('now', new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur')))
            ->getQuery()
            ->getResult();

        return $qb;
    }


    public function findCinemaHallDetails(int $cinemaId, string $startingTime) //statingTime later will be converted to \DateTime
    {

        $date = new \DateTime($startingTime);

        return $this->createQueryBuilder('c')
            ->select(
                'ch.hallId',
                'ch.hallName',
                'ch.capacity',
                'ch.hallType',
                'c.cinemaId',
                'c.name AS cinemaName',
                'ms.startingTime'
            )
            ->join('c.cinemaHalls', 'ch')
            ->join('ch.movieSchedules', 'ms')
            ->where('c.cinemaId = :cinemaId')
            ->andWhere('ms.startingTime = :startingTime')
            ->setParameter('cinemaId', $cinemaId)
            ->setParameter('startingTime', $date->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult();
    }

}






/*
* SELECT c.cinemaId, c.name AS cinemaName, c.address, c.city, c.state, c.openingHours,
       ch.hallId, ch.hallName, ch.hallType,
       ms.startingTime,
       m.movieId, m.title AS movieTitle, m.duration, m.language, m.description
        FROM Cinema c
        JOIN CinemaHall ch ON c.cinemaId = ch.cinemaId
        JOIN MovieSchedule ms ON ch.hallId = ms.cinemaHallId
        JOIN Movie m ON ms.movieId = m.movieId
        WHERE ch.hallType = :hallType
        AND DATE(ms.startingTime) = :startingTime
        AND m.movieId = :movieId;
        AND ms.startingTime > NOW()
        AND m.movieId = :movieId
        AND DATE(ms.startingTime) = :startingTime
*
*
*/