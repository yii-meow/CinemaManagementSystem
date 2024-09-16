<?php

namespace App\models;

use App\repositories\CinemaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CinemaRepository::class)]
#[ORM\Table(name: 'Cinema')]
class Cinema
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $cinemaId;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $state;

    #[ORM\Column(type: 'string', length: 255)]
    private $openingHours;

    #[ORM\OneToMany(mappedBy: 'cinema', targetEntity: CinemaHall::class, fetch: "EXTRA_LAZY")]
    private $cinemaHalls;

    public function __construct()
    {
        $this->cinemaHalls = new ArrayCollection();
    }

    // Getters and setters

    public function getCinemaId(): ?int
    {
        return $this->cinemaId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getOpeningHours(): string
    {
        return $this->openingHours;
    }

    public function setOpeningHours(string $openingHours): self
    {
        $this->openingHours = $openingHours;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCinemaHalls()
    {
        return $this->cinemaHalls;
    }

    /**
     * @param mixed $cinemaHalls
     */
    public function setCinemaHalls($cinemaHalls): void
    {
        $this->cinemaHalls = $cinemaHalls;
    }
}