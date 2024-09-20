<?php

namespace App\repositories;

use App\models\CinemaHall;
use App\models\Movie;
use App\models\MovieSchedule;
use App\models\Seat;
use App\models\Ticket;
use Doctrine\ORM\EntityRepository;

class SeatRepository extends EntityRepository
{
    public function findAllSeatsOfTheMovieOfTheDateTime(int $movieId, string $date, int $movieScheduleId) {
        $dateTime = new \DateTime($date, new \DateTimeZone('Asia/Kuala_Lumpur'));

        return $this->createQueryBuilder('s')
            ->select('s.seatId, s.seatNo, ch.hallType, ch.hallName, ms.startingTime, ms.movieScheduleId, m.title, t.ticketId')
            ->innerJoin(CinemaHall::class, 'ch', 'WITH', 's.cinemaHall = ch')
            ->innerJoin(MovieSchedule::class, 'ms', 'WITH', 'ch.hallId = ms.cinemaHall')
            ->innerJoin(Movie::class, 'm', 'WITH', 'ms.movie = m')
            ->innerJoin(Ticket::class, 't', 'WITH', 'ms.movieScheduleId = t.movieSchedule AND s.ticket = t')
            ->where('ms.startingTime = :startingTime')
            ->andWhere('ms.movieScheduleId = :movieScheduleId')
            ->andWhere('m.movieId = :movieId')
            ->setParameter('startingTime', $dateTime)
            ->setParameter('movieScheduleId', $movieScheduleId)
            ->setParameter('movieId', $movieId)
            ->getQuery()
            ->getResult();

    }
}