<?php
namespace App\models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'User')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $userId;

    #[ORM\Column(type: 'string', length: 255)]
    private $userName;

    #[ORM\Column(type: 'string', length: 255)]
    private $birthDate;

    #[ORM\Column(type: 'string', length: 255)]
    private $phoneNo;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $profileImg;

    #[ORM\Column(type: 'integer')]
    private $coins;

    #[ORM\Column(type: 'string', length: 1)]
    private $gender;

    #[ORM\Column(type: 'string', length: 50)]
    private $status;

    // For foreign side
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserReward::class)]
    private $userRewards;
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: 'Post')]
    private $posts;
    #[ORM\OneToMany(mappedBy: 'commenter', targetEntity: 'Comment')]
    private $commenters;

    #[ORM\OneToMany(mappedBy: 'userReply', targetEntity: 'Reply')]
    private $reply;

    #[ORM\OneToMany(mappedBy: 'likedBy', targetEntity: 'Likes')]
    private $liker;


    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserReward::class)]
    private $users;


    // Getters and Setters

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }


    public function setUserName(string $userName): self
    {
        $this->userName = $userName;
        return $this;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getPhoneNo(): string
    {
        return $this->phoneNo;
    }

    public function setPhoneNo(string $phoneNo): self
    {
        $this->phoneNo = $phoneNo;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getProfileImg(): ?string
    {
        return $this->profileImg;
    }

    public function setProfileImg(?string $profileImg): self
    {
        $this->profileImg = $profileImg;
        return $this;
    }

    public function getCoins(): int
    {
        return $this->coins;
    }

    public function setCoins(int $coins): self
    {
        $this->coins = $coins;
        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;
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

}