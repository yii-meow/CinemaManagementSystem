<?php
////
////namespace App\models;
////
////use App\repositories\CinemaHallRepository;
////use Doctrine\Common\Collections\Collection;
////use Doctrine\ORM\Mapping as ORM;
////
////#[ORM\Entity(repositoryClass: CinemaHallRepository::class)]
////#[ORM\Table(name: 'CinemaHall')]
////class CinemaHall
////{
////    #[ORM\Id]
////    #[ORM\GeneratedValue]
////    #[ORM\Column(type: 'integer')]
////    private $hallId;
////
////
////    #[ORM\Column(type: 'string')]
////    private $hallName;
////
////    #[ORM\Column(type: 'integer')]
////    private $capacity;
////
////    #[ORM\Column(type: 'string')]
////    private $hallType;
////
////
////    //Foreign Key
////    #[ORM\ManyToOne(targetEntity: Cinema::class)]
////    #[ORM\JoinColumn(name: "cinemaId", referencedColumnName: "cinemaId", onDelete: "CASCADE")]
////    private Collection $cinemas;
////
////
////
////
//////
//////    /**
//////     * @ORM\ManyToOne(targetEntity="App\Entity\Cinema", inversedBy="halls")
//////     * @ORM\JoinColumn(nullable=false)
//////     */
////////    #[ORM\JoinColumn(name: 'cinemaId', referencedColumnName: 'cinemaId')]
//////    private $cinema;
////
////    public function getHallId()
////    {
////        return $this->hallId;
////    }
////
////    public function setHallId($hallId): void
////    {
////        $this->hallId = $hallId;
////    }
////
////    public function getCapacity()
////    {
////        return $this->capacity;
////    }
////
////    public function setCapacity($capacity): void
////    {
////        $this->capacity = $capacity;
////    }
////
////    public function getHallName()
////    {
////        return $this->hallName;
////    }
////
////
////    public function setHallName($hallName): void
////    {
////        $this->hallName = $hallName;
////    }
////
////    public function getCinema()
////    {
////        return $this->cinema;
////    }
////
////    public function setCinema($cinema): void
////    {
////        $this->cinema = $cinema;
////    }
////
////
////
//////
//////    public function getCinemaHallOfMovie($arr)
//////    {
//////        $query = "WITH RankedHalls AS (
//////                        SELECT
//////                            ms.startingTime,
//////                            c.hallId,
//////                            c.hallName,
//////                            c.capacity,
//////                            c.hallType,
//////                            c.cinemaId,
//////                            ROW_NUMBER() OVER (PARTITION BY c.hallType ORDER BY ms.startingTime) AS rn
//////                        FROM Movie m
//////                        JOIN MovieSchedule ms ON m.movieId = ms.movieId
//////                        JOIN CinemaHall c ON ms.cinemaHallId = c.hallId
//////                        WHERE m.movieId = :movieId
//////                          AND ms.startingTime = :startingTime
//////                    )
//////                    SELECT
//////                        startingTime, hallId, hallName, capacity, hallType, cinemaId
//////                    FROM RankedHalls
//////                    WHERE rn = 1
//////                    ORDER BY startingTime;";
//////
//////        $result = $this->query($query, $arr);
//////
//////        return $result;
//////    }
//////
//////    //Get capacity of the hall
//////    public function getCinemaHallCapacity($arr){
//////        $query = "SELECT ch.hallId, ch.hallName, ch.capacity, ch.hallType, c.cinemaId, c.name AS cinemaName, ms.startingTime
//////                    FROM Cinema c
//////                    JOIN CinemaHall ch ON c.cinemaId = ch.cinemaId
//////                    JOIN MovieSchedule ms ON ch.hallId = ms.cinemaHallId
//////                    WHERE c.cinemaId = :cinemaId
//////                    AND ms.startingTime = :startingTime;";
//////
//////        $result = $this->query($query, $arr);
//////
//////        return $result;
//////    }
////
////
////}
////
////
////
////
////
//
//
//namespace App\Entity;
//
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ORM\Entity(repositoryClass="App\Repository\CinemaHallRepository")
// */
//class CinemaHall
//{
//    /**
//     * @ORM\Id
//     * @ORM\GeneratedValue
//     * @ORM\Column(type="integer")
//     */
//    private $hallId;
//
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $hallName;
//
//    /**
//     * @ORM\Column(type="integer")
//     */
//    private $capacity;
//
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $hallType;
//
//    /**
//     * @ORM\ManyToOne(targetEntity="Cinema")
//     * @ORM\JoinColumn(name="cinemaId", referencedColumnName="cinemaId")
//     */
//    private $cinema;
//
//    public function getHallId(): ?int
//    {
//        return $this->hallId;
//    }
//
//    public function setHallId(int $hallId): self
//    {
//        $this->hallId = $hallId;
//        return $this;
//    }
//
//    public function getHallName(): ?string
//    {
//        return $this->hallName;
//    }
//
//    public function setHallName(string $hallName): self
//    {
//        $this->hallName = $hallName;
//        return $this;
//    }
//
//    public function getCapacity(): ?int
//    {
//        return $this->capacity;
//    }
//
//    public function setCapacity(int $capacity): self
//    {
//        $this->capacity = $capacity;
//        return $this;
//    }
//
//    public function getHallType(): ?string
//    {
//        return $this->hallType;
//    }
//
//    public function setHallType(string $hallType): self
//    {
//        $this->hallType = $hallType;
//        return $this;
//    }
//
//    public function getCinema(): ?Cinema
//    {
//        return $this->cinema;
//    }
//
//    public function setCinema(?Cinema $cinema): self
//    {
//        $this->cinema = $cinema;
//        return $this;
//    }
//}


namespace App\models;

use App\repositories\CinemaHallRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CinemaHallRepository::class)]
#[ORM\Table(name: 'CinemaHall')]
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

    #[ORM\ManyToOne(targetEntity: Cinema::class)]
    #[ORM\JoinColumn(name: 'cinemaId', referencedColumnName: 'cinemaId')]
    private $cinema;

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
}

