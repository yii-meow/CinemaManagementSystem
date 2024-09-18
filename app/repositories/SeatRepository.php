<?php

namespace App\repositories;

use App\models\MovieSchedule;
use Doctrine\ORM\EntityRepository;

class SeatRepository extends EntityRepository
{
    public function findAllSeatsOfTheMovieOfTheDateTime(int $movieId, string $date){

        $dateTime = new \DateTime($date, new \DateTimeZone('Asia/Kuala_Lumpur'));

         return $this->createQueryBuilder('s')
            ->select('s.seatId, s.seatNo, ch.hallType, ch.hallName, ms.startingTime, m.title')
            ->innerJoin('s.cinemaHall', 'ch')  // Join with CinemaHall
            ->innerJoin('ch.movieSchedules', 'ms')  // Join with MovieSchedule through CinemaHall
            ->innerJoin('ms.movie', 'm')  // Join with Movie through MovieSchedule
            ->where('ms.startingTime = :dateTime')
            ->andWhere('m.movieId = :movieId')
            ->setParameter('dateTime', $dateTime)
            ->setParameter('movieId', $movieId)
            ->orderBy('s.seatNo', 'ASC')
            ->getQuery()
            ->getResult();
    }
}