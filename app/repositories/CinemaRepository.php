<?php

namespace App\repositories;

use App\models\Cinema;
use Doctrine\ORM\EntityRepository;

class CinemaRepository extends EntityRepository
{
    public function findByState($state)
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

}