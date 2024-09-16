<?php

namespace App\models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Admin')]
class Admin
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $userId;

    #[ORM\Column(type: 'string', length: 255)]
    private $userName;

    #[ORM\Column(type: 'string', length: 15)]
    private $phoneNo;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'string', length: 50)]
    private $role;

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

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }
}