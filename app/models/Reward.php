<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Reward')]
class Reward
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $rewardId;

    #[ORM\Column(type: 'string', length: 255)]
    private $rewardTitle;

    #[ORM\Column(type: 'string', length: 255)]
    private $category;

    #[ORM\Column(type: 'text', nullable: true)]
    private $details;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $qty;

    #[ORM\Column(type: 'integer')]
    private $neededCoins;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $rewardImg;

    // Getters and Setters

    public function getRewardId(): ?int
    {
        return $this->rewardId;
    }

    public function getRewardTitle(): string
    {
        return $this->rewardTitle;
    }

    public function setRewardTitle(string $rewardTitle): self
    {
        $this->rewardTitle = $rewardTitle;
        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;
        return $this;
    }

    public function getNeededCoins(): int
    {
        return $this->neededCoins;
    }

    public function setNeededCoins(int $neededCoins): self
    {
        $this->neededCoins = $neededCoins;
        return $this;
    }

    public function getRewardImg(): ?string
    {
        return $this->rewardImg;
    }

    public function setRewardImg(?string $rewardImg): self
    {
        $this->rewardImg = $rewardImg;
        return $this;
    }
}