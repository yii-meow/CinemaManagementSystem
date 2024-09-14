<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'UserReward')]
class UserReward
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $userRewardId;

    #[ORM\Column(type: 'integer')]
    private $userId;

    #[ORM\Column(type: 'integer')]
    private $rewardId;

    #[ORM\Column(type: 'string', length: 50)]
    private $status;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $redeemDate;

    // Getters and Setters

    public function getUserRewardId(): ?int
    {
        return $this->userRewardId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getRewardId(): int
    {
        return $this->rewardId;
    }

    public function setRewardId(int $rewardId): self
    {
        $this->rewardId = $rewardId;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getRedeemDate(): ?\DateTime
    {
        return $this->redeemDate;
    }

    public function setRedeemDate(?\DateTime $redeemDate): self
    {
        $this->redeemDate = $redeemDate;
        return $this;
    }
}