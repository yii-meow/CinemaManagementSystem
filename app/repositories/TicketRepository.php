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

}