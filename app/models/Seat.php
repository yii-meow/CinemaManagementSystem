<?php
namespace App\models;


use App\repositories\SeatRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: SeatRepository::class)]
#[ORM\Table(name: 'Seat')]
class Seat
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $seatId;

    #[ORM\Column(type: 'string', length: 5)]
    private $seatNo;

    #[ORM\ManyToOne(targetEntity: CinemaHall::class, inversedBy: 'seats')]
    #[ORM\JoinColumn(name: 'hallId', referencedColumnName: 'hallId')]
    private $cinemaHall;

    #[ORM\ManyToOne(targetEntity: Ticket::class, inversedBy: 'seats')]
    #[ORM\JoinColumn(name: 'ticketIDD', referencedColumnName: 'ticketId')]
    private $ticket;


    public function getSeatId(): ?int
    {
        return $this->seatId;
    }

    public function getSeatNo(): string
    {
        return $this->seatNo;
    }

    public function setSeatNo(string $seatNo): self
    {
        $this->seatNo = $seatNo;
        return $this;
    }

    public function getCinemaHall(): ?CinemaHall
    {
        return $this->cinemaHall;
    }

    public function setCinemaHall(?CinemaHall $cinemaHall): self
    {
        $this->cinemaHall = $cinemaHall;
        return $this;
    }

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(?Ticket $ticket): self
    {
        $this->ticket = $ticket;
        return $this;
    }
}