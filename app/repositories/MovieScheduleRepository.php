<?php

namespace App\repositories;

use App\models\MovieSchedule;
use App\models\Movie;
use Doctrine\ORM\EntityRepository;
use DoctrineExtensions\Query\Mysql\Date;


class MovieScheduleRepository extends EntityRepository
{
    public function findByMovieScheduleDate(int $movieId)
    {
        $today = new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur'));

        $results = $this->createQueryBuilder("ms")
            ->select('ms.startingTime', 'ms.movieScheduleId')
            ->where('ms.movie = :movie')
            ->andWhere('ms.startingTime >= :today')
            ->setParameter('movie', $movieId)
            ->setParameter('today', $today->format('Y-m-d H:i:s'))
            ->orderBy('ms.startingTime', 'ASC')
            ->getQuery()
            ->getResult();

        // Filter distinct startingTimes
        $distinctResults = [];
        foreach ($results as $result) {
            $startingTimeKey = $result['startingTime']->format('Y-m-d');
            if (!isset($distinctResults[$startingTimeKey])) {
                $distinctResults[$startingTimeKey] = $result;
            }
        }

        return array_values($distinctResults);
    }

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

    public function findUpcomingSchedulesByHall(int $hallId)
    {
        return $this->createQueryBuilder('ms')
            ->select('ms', 'm')
            ->join('ms.movie', 'm')
            ->where('ms.cinemaHall = :hallId')
            ->andWhere('ms.startingTime >= :now')
            ->setParameter('hallId', $hallId)
            ->setParameter('now', new \DateTime())
            ->orderBy('ms.startingTime', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findCinemaHallOfMovie(int $movieId, string $selectedDate) //string be ensured converted to \DateTime
    {
        $date = new \DateTime($selectedDate, new \DateTimeZone('Asia/Kuala_Lumpur'));
        $qb = $this->createQueryBuilder('ms')
            ->select('ch.hallType', 'ch.hallName', 'ch.capacity', 'ch.hallId', 'ms.startingTime')
            ->join('ms.cinemaHall', 'ch')
            ->where('ms.movie = :movieId')
            ->andWhere('ms.startingTime >= :date_start')
            ->andWhere('ms.startingTime <= :date_end')
            ->setParameter('movieId', $movieId)
            ->setParameter('date_start', $date->format('Y-m-d 00:00:00'))  //Get a specific date
            ->setParameter('date_end', $date->format('Y-m-d 23:59:59'))  //Get a specific date
            ->groupBy('ch.hallType');

        return $qb->getQuery()->getResult();
    }

    public function findTodayMovieSchedules($search = '', $category = '')
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $today = new \DateTime('today');
        $tomorrow = new \DateTime('tomorrow');

        $qb->select('m', 'ms', 'ch', 'c')
            ->from(Movie::class, 'm')
            ->leftJoin('m.movieSchedules', 'ms')
            ->leftJoin('ms.cinemaHall', 'ch')
            ->leftJoin('ch.cinema', 'c')
            ->where('m.status = :status')
            ->andWhere('ms.startingTime >= :today')
            ->andWhere('ms.startingTime < :tomorrow')
            ->setParameter('status', 'Now Showing')
            ->setParameter('today', $today)
            ->setParameter('tomorrow', $tomorrow);

        if ($search) {
            $qb->andWhere($qb->expr()->like('m.title', ':search'))
                ->setParameter('search', '%' . $search . '%');
        }

        if ($category && $category !== 'All') {
            $qb->andWhere($qb->expr()->like('m.catagory', ':category'))
                ->setParameter('category', '%' . $category . '%');
        }

        return $qb->getQuery()->getResult();
    }

    public function getTopFiveMovies()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('m.movieId, m.title, m.photo, COUNT(ms.movieScheduleId) as scheduleCount')
            ->from(Movie::class, 'm')
            ->leftJoin('m.movieSchedules', 'ms')
            ->where('m.status = :status')
            ->setParameter('status', 'Now Showing')
            ->groupBy('m.movieId')
            ->orderBy('scheduleCount', 'DESC')
            ->setMaxResults(5);

        return $qb->getQuery()->getResult();
    }
}