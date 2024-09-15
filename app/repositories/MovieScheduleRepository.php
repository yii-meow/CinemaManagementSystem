<?php

namespace App\repositories;

use App\models\MovieSchedule;
use Doctrine\ORM\EntityRepository;


class MovieScheduleRepository extends EntityRepository
{
    public function findByMovieScheduleDate($movieId)
    {
        return $this->createQueryBuilder('ms')
            ->select('ms.startingTime')
            ->addSelect('MIN(ms.movieScheduleId) AS movieScheduleId')
            ->where('ms.movie = :movieId')
            ->andWhere('ms.startingTime > CURRENT_TIMESTAMP()')
            ->setParameter('movieId', $movieId)
            ->groupBy('ms.startingTime')
            ->orderBy('ms.startingTime', 'ASC')
            ->getQuery()
            ->getResult();
    }
}