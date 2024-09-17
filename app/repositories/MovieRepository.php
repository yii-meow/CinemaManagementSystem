<?php

namespace App\repositories;

use Doctrine\ORM\EntityRepository;

class MovieRepository extends EntityRepository
{

    public function findComingSoonMovies()
    {
        return $this->createQueryBuilder('m')
            ->where('m.status = :status')
            ->setParameter('status', 'Coming Soon')
            ->orderBy('m.releaseDate', 'ASC')
            ->getQuery()
            ->getResult();
    }
}


