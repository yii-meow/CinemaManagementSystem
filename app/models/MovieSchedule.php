<?php

namespace App\models;

use App\repositories\MovieScheduleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieScheduleRepository::class)]
#[ORM\Table(name: 'MovieSchedule')]
#[ORM\Index(columns: ["movieId"], name: "idx_movie")]
#[ORM\Index(columns: ["cinemaHallId"], name: "idx_cinema_hall")]
class MovieSchedule
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $movieScheduleId;

    #[ORM\Column(type: 'datetime')]
    private $startingTime;

    #[ORM\ManyToOne(targetEntity: Movie::class, inversedBy: 'movieSchedules')]
    #[ORM\JoinColumn(name: 'movieId', referencedColumnName: 'movieId', nullable: false)]
    private $movie = null;

    #[ORM\ManyToOne(targetEntity: CinemaHall::class, inversedBy: 'movieSchedules')]
    #[ORM\JoinColumn(name: 'cinemaHallId', referencedColumnName: 'hallId')]
    private $cinemaHall = null;

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
