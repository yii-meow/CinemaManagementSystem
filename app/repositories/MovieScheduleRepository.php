<?php

namespace App\repositories;

use App\models\MovieSchedule;
use Doctrine\ORM\EntityRepository;


class MovieScheduleRepository extends EntityRepository
{
    public function findByMovieScheduleDate($movieId)
    {
        $today = new \DateTime();
        $tomorrow = (new \DateTime())->modify('+1 day');

        $query = $this->createQueryBuilder('ms')
            ->select('m.movieId, m.title, m.duration, m.language')
            ->addSelect('GROUP_CONCAT(ms.startingTime) AS scheduleTimes')
            ->innerJoin('ms.movie', 'm')
            ->where('ms.startingTime >= :today')
            ->andWhere('ms.startingTime < :tomorrow')
            ->setParameter('today', $today->format('Y-m-d 00:00:00'))
            ->setParameter('tomorrow', $tomorrow->format('Y-m-d 00:00:00'))
            ->groupBy('m.movieId')
            ->orderBy('m.title', 'ASC')
            ->getQuery();

        $results = $query->getResult();

        // Post-process to convert the concatenated string of times into an array
        foreach ($results as &$result) {
            $result['scheduleTimes'] = explode(',', $result['scheduleTimes']);
            sort($result['scheduleTimes']);
        }

        return $results;
    }
}