<?php

namespace App\models;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'Payment')]
class Payment
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $paymentId;

    #[ORM\Column(type: 'decimal', precision: 8, scale: 2)]
    private $totalPrice;

    #[ORM\Column(type: 'string', length: 255)]
    private $paymentMethod;

    #[ORM\Column(type: 'string', length: 255)]
    private $custInfo;

    #[ORM\Column(type: 'string', length: 255)]
    private $paymentInfo;

    #[ORM\Column(type: 'string', length: 255)]
    private $paymentStatus;

    #[ORM\ManyToOne(targetEntity: Ticket::class, inversedBy: 'payments')]
    #[ORM\JoinColumn(name: 'ticketId', referencedColumnName: 'ticketId')]
    private $ticket;


    public function getCustInfo()
    {
        return $this->custInfo;
    }

    public function setCustInfo($custInfo): void
    {
        $this->custInfo = $custInfo;
    }

    public function getPaymentInfo()
    {
        return $this->paymentInfo;
    }

    public function setPaymentInfo($paymentInfo): void
    {
        $this->paymentInfo = $paymentInfo;
    }


    public function getPaymentId(): ?int
    {
        return $this->paymentId;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }


    public function getPaymentStatus(): string
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(string $paymentStatus): self
    {
        $this->paymentStatus = $paymentStatus;
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