<?php

namespace App\models;


use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'Ticket')]
class Ticket
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $ticketId;

    #[ORM\Column(type: 'string', length: 10)]
    private $ticketStatus;

    #[ORM\ManyToOne(targetEntity: MovieSchedule::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(name: 'movieScheduleId', referencedColumnName: 'movieScheduleId')]
    private $movieSchedule;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(name: 'userId', referencedColumnName: 'userId')]
    private $user;



    #[ORM\OneToMany(mappedBy: 'ticket', targetEntity: Seat::class, fetch: "EXTRA_LAZY")]
    private $seats;

    #[ORM\OneToMany(mappedBy: 'ticket', targetEntity: Payment::class, fetch: "EXTRA_LAZY")]
    private $payment;


    public function getTicketId()
    {
        return $this->ticketId;
    }

    public function setTicketId($ticketId): void
    {
        $this->ticketId = $ticketId;
    }

    public function getTicketStatus()
    {
        return $this->ticketStatus;
    }

    public function setTicketStatus($ticketStatus): void
    {
        $this->ticketStatus = $ticketStatus;
    }

    public function getMovieSchedule(): ?MovieSchedule
    {
        return $this->movieSchedule;
    }

    public function setMovieSchedule($movieSchedule): void
    {
        $this->movieSchedule = $movieSchedule;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function getSeats(): ?Seat
    {
        return $this->seats;
    }


    public function setSeats($seats): void
    {
        $this->seats = $seats;
    }


    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment($payment): void
    {
        $this->payment = $payment;
    }



}