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

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userRewards')]
    #[ORM\JoinColumn(name: 'userId', referencedColumnName: 'userId')]
    private $user;

    #[ORM\ManyToOne(targetEntity: Reward::class, inversedBy: 'userRewards')]
    #[ORM\JoinColumn(name: 'rewardId', referencedColumnName: 'rewardId')]
    private $reward;

    #[ORM\Column(type: 'string', length: 50)]
    private $status;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $redeemDate;

    // Getters and Setters

    public function getUserRewardId(): ?int
    {
        return $this->userRewardId;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getReward(): ?Reward
    {
        return $this->reward;
    }

    public function setReward(?Reward $reward): self
    {
        $this->reward = $reward;
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