<?php

namespace App\repositories;


use App\models\MovieSchedule;
use Doctrine\ORM\EntityRepository;
use DoctrineExtensions\Query\Mysql\Date;

class TicketRepository extends EntityRepository
{
    public function findUserTickets($userId)
    {
        $qb = $this->createQueryBuilder('t')
            ->select([
                't.ticketId',
                't.ticketStatus',
                't.qrCodeURL',
                'ms.startingTime',
                'm.title AS movieTitle',
                'm.duration AS movieDuration',
                'ch.hallName',
                'ch.hallType',
                'p.paymentId',
                'p.totalPrice',
                'p.paymentMethod',
                'p.paymentStatus',
                's.seatNo',
            ])
            ->innerJoin('t.movieSchedule', 'ms')    // Join MovieSchedule
            ->innerJoin('ms.movie', 'm')            // Join Movie
            ->innerJoin('t.seats', 's')             // Join Seat
            ->innerJoin('s.cinemaHall', 'ch')       // Join CinemaHall
            ->leftJoin('t.payment', 'p')            // Left join Payment
            ->where('t.user = :userId')             // Filter by user ID
            ->setParameter('userId', $userId)       // Bind the user ID parameter
            ->orderBy('ms.startingTime', 'DESC');    // Order by starting time

        $tickets = $qb->getQuery()->getResult();
        $groupedTickets = [];

        foreach ($tickets as $ticket) {
            $ticketId = $ticket['ticketId'];

            if (!isset($groupedTickets[$ticketId])) {
                $groupedTickets[$ticketId] = $ticket;
                $groupedTickets[$ticketId]['seats'] = [];
            }

            // Add the seatNo to the list of seats for this ticket
            $groupedTickets[$ticketId]['seats'][] = $ticket['seatNo'];
        }

        foreach ($groupedTickets as &$ticket) {
            $ticket['seatNo'] = implode(', ', $ticket['seats']);
        }

        return $groupedTickets;
    }


    public function findAllTickets()
    {
        $qb = $this->createQueryBuilder('t')
            ->select([
                't.ticketId',
                'u.userName AS customerName',
                't.ticketStatus',
                'ms.startingTime',
                'm.title AS movieTitle',
                'ch.hallName',
                'ch.hallType',
                'p.paymentStatus',
                'p.totalPrice',
                'p.custInfo',
                's.seatNo'
            ])
            ->innerJoin('t.user', 'u')              // Join User
            ->innerJoin('t.movieSchedule', 'ms')    // Join MovieSchedule
            ->innerJoin('ms.movie', 'm')            // Join Movie
            ->innerJoin('t.seats', 's')             // Join Seat
            ->innerJoin('s.cinemaHall', 'ch')       // Join CinemaHall
            ->leftJoin('t.payment', 'p')            // Left join Payment
            ->orderBy('t.ticketId', 'ASC');         // Order by ticket ID

        $tickets = $qb->getQuery()->getResult();
        $groupedTickets = [];

        // Group seats by ticketId
        foreach ($tickets as $ticket) {
            $ticketId = $ticket['ticketId'];

            if (!isset($groupedTickets[$ticketId])) {
                $groupedTickets[$ticketId] = $ticket;
                $groupedTickets[$ticketId]['seats'] = [];
            }

            // Add the seat number to the seats array for this ticket
            $groupedTickets[$ticketId]['seats'][] = $ticket['seatNo'];
        }

        // Concatenate seat numbers into a single string
        foreach ($groupedTickets as &$ticket) {
            $ticket['seatNo'] = implode(', ', $ticket['seats']);
        }

        return $groupedTickets;
    }


    public function findTicketById($ticketId)
    {
        $qb = $this->createQueryBuilder('t')
            ->select([
                't.ticketId',
                'u.userName AS customerName',
                't.ticketStatus',
                'ms.startingTime',
                'm.title AS movieTitle',
                'ch.hallName',
                'ch.hallType',
                'p.paymentStatus',
                'p.totalPrice',
                's.seatNo'
            ])
            ->innerJoin('t.user', 'u')              // Join User
            ->innerJoin('t.movieSchedule', 'ms')    // Join MovieSchedule
            ->innerJoin('ms.movie', 'm')            // Join Movie
            ->innerJoin('t.seats', 's')             // Join Seat
            ->innerJoin('s.cinemaHall', 'ch')       // Join CinemaHall
            ->leftJoin('t.payment', 'p')            // Left join Payment
            ->where('t.ticketId = :ticketId')       // Filter by specific ticket ID
            ->setParameter('ticketId', $ticketId)   // Bind the ticket ID parameter
            ->orderBy('t.ticketId', 'ASC');         // Order by ticket ID

        $tickets = $qb->getQuery()->getArrayResult();
        $groupedTickets = [];

        // Group seats by ticketId
        foreach ($tickets as $ticket) {
            $ticketId = $ticket['ticketId'];

            if (!isset($groupedTickets[$ticketId])) {
                $groupedTickets[$ticketId] = $ticket;
                $groupedTickets[$ticketId]['seats'] = [];
            }

            // Add the seat number to the seats array for this ticket
            $groupedTickets[$ticketId]['seats'][] = $ticket['seatNo'];
        }

        // Concatenate seat numbers into a single string
        foreach ($groupedTickets as &$ticket) {
            $ticket['seatNo'] = implode(', ', $ticket['seats']);
        }

        return array_values($groupedTickets);
    }



//    public function findAllSeatsOfTheMovieOfTheDateTime(int $movieId, string $date, int $movieScheduleId){
//
//        $dateTime = new \DateTime($date, new \DateTimeZone('Asia/Kuala_Lumpur'));
//
//        return $this->createQueryBuilder('t')
//            ->select('t.ticketId, t.ticketStatus, t.qrCodeURL, ms.startingTime, m.title, u.userId')
//            ->innerJoin('t.movieSchedule', 'ms')  // Join with MovieSchedule
//            ->innerJoin('ms.movie', 'm')  // Join with Movie
//            ->innerJoin('t.user', 'u')  // Join with User
//            ->where('ms.movieScheduleId = :movieScheduleId')  // Correct reference to movieScheduleId
//            ->andWhere('m.movieId = :movieId')
//            ->andWhere('ms.startingTime = :dateTime')
//            ->setParameter('movieScheduleId', $movieScheduleId)  // Set the movieScheduleId parameter
//            ->setParameter('movieId', $movieId)  // Set the movieId parameter
//            ->setParameter('dateTime', $dateTime)  // Set the dateTime parameter
//            ->getQuery()
//            ->getResult();
//    }
}