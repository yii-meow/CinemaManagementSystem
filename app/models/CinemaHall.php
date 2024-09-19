<?php

namespace App\models;

use App\repositories\CinemaHallRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CinemaHallRepository::class)]
#[ORM\Table(name: 'CinemaHall')]
#[ORM\Index(columns: ["cinemaId"], name: "idx_cinema")]
class CinemaHall
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $hallId;

    #[ORM\Column(type: 'string', length: 255)]
    private $hallName;

    #[ORM\Column(type: 'integer')]
    private $capacity;

    #[ORM\Column(type: 'string', length: 255)]
    private $hallType;

    #[ORM\ManyToOne(targetEntity: Cinema::class, inversedBy: 'cinemaHalls')]
    #[ORM\JoinColumn(name: 'cinemaId', referencedColumnName: 'cinemaId')]
    private $cinema;


//    #[ORM\OneToMany(mappedBy: 'cinemaHall', targetEntity: MovieSchedule::class, fetch: "EXTRA_LAZY")]
//    private $movieSchedules;
//
//    #[ORM\OneToMany(mappedBy: 'cinemaHall', targetEntity: Seat::class, fetch: "EXTRA_LAZY")]
//    private $seats;

    #[ORM\OneToMany(mappedBy: 'cinemaHall', targetEntity: MovieSchedule::class, fetch: "EXTRA_LAZY")]
    private $movieSchedules;

    #[ORM\OneToMany(mappedBy: 'cinemaHall', targetEntity: Seat::class, fetch: "EXTRA_LAZY")]
    private $seats;


    public function getSeats()
    {
        return $this->seats;
    }

    public function setSeats($seats): void
    {
        $this->seats = $seats;
    }



    public function getHallId(): ?int
    {
        return $this->hallId;
    }

    public function getHallName(): string
    {
        return $this->hallName;
    }

    public function setHallName(string $hallName): self
    {
        $this->hallName = $hallName;
        return $this;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;
        return $this;
    }

    public function getHallType(): string
    {
        return $this->hallType;
    }

    public function setHallType(string $hallType): self
    {
        $this->hallType = $hallType;
        return $this;
    }

    public function getCinema(): ?Cinema
    {
        return $this->cinema;
    }

    public function setCinema(?Cinema $cinema): self
    {
        $this->cinema = $cinema;
        return $this;
    }

    // Getter for movieSchedules
    public function getMovieSchedules()
    {
        return $this->movieSchedules;
    }

    // Setter for movieSchedules
    public function setMovieSchedules($movieSchedules)
    {
        $this->movieSchedules = $movieSchedules;
    }
}

