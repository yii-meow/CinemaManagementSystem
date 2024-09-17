<?php

namespace App\models;

use App\repositories\TicketPricingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketPricingRepository::class)]
#[ORM\Table(name: 'TicketPricing')]
class TicketPricing
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $TicketPricingId;


    #[ORM\Column(type: 'float')]
    private $baseTicketIMAX = 18;
    #[ORM\Column(type: 'float')]
    private $baseTicketDeluxe = 25;
    #[ORM\Column(type: 'float')]
    private $baseTicketAtmos = 45;
    #[ORM\Column(type: 'float')]
    private $baseTicketBenie = 70;


    #[ORM\Column(type: 'float')]
    private $timeBasedWeekdayBefore12 = -20;
    #[ORM\Column(type: 'float')]
    private $timeBasedWeekdayAfter12 = 0;
    #[ORM\Column(type: 'float')]
    private $timeBasedWeekend = 10;
    #[ORM\Column(type: 'float')]
    private $timeBasedMidnight = -10;


    #[ORM\Column(type: 'float')]
    private $commissionFee = 1.5;

    public function getBaseTicketAtmos(): int
    {
        return $this->baseTicketAtmos;
    }

    public function setBaseTicketAtmos(int $baseTicketAtmos): void
    {
        $this->baseTicketAtmos = $baseTicketAtmos;
    }

    public function getTicketPricingId()
    {
        return $this->TicketPricingId;
    }


    public function setTicketPricingId($TicketPricingId): void
    {
        $this->TicketPricingId = $TicketPricingId;
    }

    public function getBaseTicketIMAX(): int
    {
        return $this->baseTicketIMAX;
    }

    public function setBaseTicketIMAX(int $baseTicketIMAX): void
    {
        $this->baseTicketIMAX = $baseTicketIMAX;
    }

    public function getBaseTicketDeluxe(): int
    {
        return $this->baseTicketDeluxe;
    }

    public function setBaseTicketDeluxe(int $baseTicketDeluxe): void
    {
        $this->baseTicketDeluxe = $baseTicketDeluxe;
    }

    public function getBaseTicketBenie(): int
    {
        return $this->baseTicketBenie;
    }

    public function setBaseTicketBenie(int $baseTicketBenie): void
    {
        $this->baseTicketBenie = $baseTicketBenie;
    }

    public function getTimeBasedWeekdayBefore12(): int
    {
        return $this->timeBasedWeekdayBefore12;
    }

    public function setTimeBasedWeekdayBefore12(int $timeBasedWeekdayBefore12): void
    {
        $this->timeBasedWeekdayBefore12 = $timeBasedWeekdayBefore12;
    }

    public function getTimeBasedWeekdayAfter12(): int
    {
        return $this->timeBasedWeekdayAfter12;
    }

    public function setTimeBasedWeekdayAfter12(int $timeBasedWeekdayAfter12): void
    {
        $this->timeBasedWeekdayAfter12 = $timeBasedWeekdayAfter12;
    }

    public function getTimeBasedWeekend(): int
    {
        return $this->timeBasedWeekend;
    }

    public function setTimeBasedWeekend(int $timeBasedWeekend): void
    {
        $this->timeBasedWeekend = $timeBasedWeekend;
    }

    public function getTimeBasedMidnight(): int
    {
        return $this->timeBasedMidnight;
    }

    public function setTimeBasedMidnight(int $timeBasedMidnight): void
    {
        $this->timeBasedMidnight = $timeBasedMidnight;
    }

    public function getCommissionFee(): float
    {
        return $this->commissionFee;
    }

    public function setCommissionFee(float $commissionFee): void
    {
        $this->commissionFee = $commissionFee;
    }








}