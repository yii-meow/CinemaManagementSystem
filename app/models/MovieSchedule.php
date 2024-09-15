<?php

namespace App\models;

use App\repositories\MovieScheduleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieScheduleRepository::class)]
#[ORM\Table(name: 'MovieSchedule')]
class MovieSchedule
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $movieScheduleId;

    #[ORM\Column(type: 'datetime')]
    private $startingTime;

    #[ORM\ManyToOne(targetEntity: Movie::class)]
    #[ORM\JoinColumn(name: 'movieId', referencedColumnName: 'movieId', nullable: false)]
    private $movie;

    #[ORM\ManyToOne(targetEntity: CinemaHall::class)]
    #[ORM\JoinColumn(name: 'cinemaHallId', referencedColumnName: 'hallId')]
    private $cinemaHall;

    public function getMovieScheduleId(): ?int
    {
        return $this->movieScheduleId;
    }

    public function getStartingTime(): \DateTimeInterface
    {
        return $this->startingTime;
    }

    public function setStartingTime(\DateTimeInterface $startingTime): self
    {
        $this->startingTime = $startingTime;
        return $this;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): self
    {
        $this->movie = $movie;
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
}
