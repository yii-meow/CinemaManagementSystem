<?php

namespace App\repositories;

use App\models\MovieSchedule;
use Doctrine\ORM\EntityRepository;


class MovieScheduleRepository extends EntityRepository
{
    public function findMovieSchedule()
    {
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $now = new \DateTime();
        $endOfDay = new \DateTime('today 23:59:59');

        $qb = $this->createQueryBuilder('ms');
        $query = $qb
            ->select('m.movieId', 'm.title', 'm.catagory', 'm.duration', 'm.language', 'm.photo', 'm.classification', 'ms.startingTime', 'ms.movieScheduleId', 'c.cinemaId', 'c.name as cinemaName', 'ch.hallType')
            ->innerJoin('ms.movie', 'm')
            ->innerJoin('ms.cinemaHall', 'ch')
            ->innerJoin('ch.cinema', 'c')
            ->where('ms.startingTime BETWEEN :now AND :endOfDay')
            ->setParameter('now', $now)
            ->setParameter('endOfDay', $endOfDay)
            ->orderBy('m.title', 'ASC')
            ->addOrderBy('ms.startingTime', 'ASC')
            ->getQuery();

        $results = $query->getResult();

        // Group the results by movie and cinema
        $groupedResults = [];
        foreach ($results as $result) {
            $movieId = $result['movieId'];
            $cinemaId = $result['cinemaId'];
            if (!isset($groupedResults[$movieId])) {
                $groupedResults[$movieId] = [
                    'movieId' => $movieId,
                    'category' => $result["catagory"],
                    'photo' => $result['photo'],
                    'title' => $result['title'],
                    'duration' => $result['duration'],
                    'language' => $result['language'],
                    'classification' => $result['classification'],
                    'cinemas' => []
                ];
            }
            if (!isset($groupedResults[$movieId]['cinemas'][$cinemaId])) {
                $groupedResults[$movieId]['cinemas'][$cinemaId] = [
                    'id' => $cinemaId,
                    'name' => $result['cinemaName'],
                    'showtimes' => []
                ];
            }
            $groupedResults[$movieId]['cinemas'][$cinemaId]['showtimes'][] = [
                'time' => $result['startingTime'],
                'hallType' => $result['hallType'],
                'scheduleId' => $result['movieScheduleId']
            ];
        }

        return array_values($groupedResults);
    }

}