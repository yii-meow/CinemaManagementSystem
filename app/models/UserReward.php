<?php

namespace App\models;

use App\repositories\UserRewardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRewardRepository::class)]
#[ORM\Table(name: 'UserReward')]
class UserReward
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $userRewardId;

    #[ORM\ManyToOne(targetEntity: Reward::class, inversedBy: 'userRewards')]
    #[ORM\JoinColumn(name: 'rewardId', referencedColumnName: 'rewardId')]
    private $reward;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userRewards')]
    #[ORM\JoinColumn(name: 'userId', referencedColumnName: 'userId')]
    private $user;

    #[ORM\Column(type: 'string', length: 20)]
    private $rewardCondition; // Changed column name

    #[ORM\Column(type: 'integer')]
    private $promoCode;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
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

    public function getRewardCondition(): string // Changed method name
    {
        return $this->rewardCondition;
    }

    public function setRewardCondition(string $condition): self // Changed method name
    {
        $this->rewardCondition = $condition;
        return $this;
    }

    public function getPromoCode(): int
    {
        return $this->promoCode;
    }

    public function setPromoCode(int $promoCode): self
    {
        $this->promoCode = $promoCode;
        return $this;
    }

    public function getRedeemDate(): string
    {
        return $this->redeemDate;
    }

    public function setRedeemDate(string $redeemDate): self
    {
        $this->redeemDate = $redeemDate;
        return $this;
    }
}