<?php

namespace App\repositories;

use App\models\MovieSchedule;
use Doctrine\ORM\EntityRepository;


class MovieScheduleRepository extends EntityRepository
{
    public function findMovieSchedule()
    {
        $now = new \DateTime();
        $endOfDay = new \DateTime('today 23:59:59');

        $qb = $this->createQueryBuilder('ms');
        $query = $qb
            ->select('m.movieId', 'm.title', 'm.duration', 'm.language', 'm.photo', 'ms.startingTime')
            ->innerJoin('ms.movie', 'm')
            ->where('ms.startingTime BETWEEN :now AND :endOfDay')
            ->setParameter('now', $now)
            ->setParameter('endOfDay', $endOfDay)
            ->orderBy('m.title', 'ASC')
            ->addOrderBy('ms.startingTime', 'ASC')
            ->getQuery();

        $results = $query->getResult();

        // Group the results by movie
        $groupedResults = [];
        foreach ($results as $result) {
            $movieId = $result['movieId'];
            if (!isset($groupedResults[$movieId])) {
                $groupedResults[$movieId] = [
                    'movieId' => $movieId,
                    'photo' => $result['photo'],
                    'title' => $result['title'],
                    'duration' => $result['duration'],
                    'language' => $result['language'],
                    'available_times' => []
                ];
            }
            $groupedResults[$movieId]['available_times'][] = $result['startingTime'];
        }

        return array_values($groupedResults);
    }

}