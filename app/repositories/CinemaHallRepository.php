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

    public function getNextHallName($cinemaId)
    {
        $query = $this->createQueryBuilder('ch')
            ->select('MAX(ch.hallName) as maxHallName')
            ->where('ch.cinema = :cinemaId')
            ->setParameter('cinemaId', $cinemaId)
            ->getQuery();

        $result = $query->getOneOrNullResult();

        if (!$result || $result['maxHallName'] === null) {
            return 'H01';
        }

        $currentNumber = intval(substr($result['maxHallName'], 1));
        $nextNumber = $currentNumber + 1;
        return 'H' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
    }
}