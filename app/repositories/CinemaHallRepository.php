<?php

namespace App\repositories;

use App\models\CinemaHall;
use App\models\Cinema;
use App\models\MovieSchedule;
use Doctrine\ORM\EntityRepository;

class CinemaHallRepository extends EntityRepository
{
    public function findByHallId($hallId)
    {
        return $this->createQueryBuilder('ch')
            ->leftJoin('ch.cinema', 'c')
            ->addSelect('c')
            ->where('ch.hallId = :hallId')
            ->setParameter('hallId', $hallId)
            ->getQuery()
            ->getOneOrNullResult();
    }

}