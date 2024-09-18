<?php
namespace App\models;

use App\Factory\UserType;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'User')]
class User extends UserType
{

    #[ORM\Column(type: 'string', length: 255)]
    private $birthDate;

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
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: 'Post')]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'commenter', targetEntity: 'Comment')]
    private Collection $commenters;

    #[ORM\OneToMany(mappedBy: 'userReply', targetEntity: 'Reply')]
    private Collection $reply;

    #[ORM\OneToMany(mappedBy: 'likedBy', targetEntity: 'Likes')]
    private Collection $liker;

    // Getters and Setters for additional fields
    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): self
    {
        $this->birthDate = $birthDate;
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

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function getCommenters(): Collection
    {
        return $this->commenters;
    }

    public function getReply(): Collection
    {
        return $this->reply;
    }

    public function getLiker(): Collection
    {
        return $this->liker;
    }
}