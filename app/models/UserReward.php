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

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userReward')]
    #[ORM\JoinColumn(name: 'userId', referencedColumnName: 'userId')]
    private $user;

    #[ORM\ManyToOne(targetEntity: Reward::class, inversedBy: 'userReward')]
    #[ORM\JoinColumn(name: 'rewardId', referencedColumnName: 'rewardId')]
    private $reward;

//    #[ORM\Column(type: 'string', length: 50)]
//    private $status;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $redeemDate;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $rewardCondition;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $promoCode;


    public function getRewardCondition()
    {
        return $this->rewardCondition;
    }

    public function setRewardCondition($rewardCondition): void
    {
        $this->rewardCondition = $rewardCondition;
    }


    // Getters and Setter



    public function getUserRewardId(): ?int
    {
        return $this->userRewardId;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
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

    public function getPromoCode(): ?string
    {
        return $this->promoCode;
    }

    public function setPromoCode(?string $promoCode): self
    {
        $this->promoCode = $promoCode;
        return $this;
    }
}