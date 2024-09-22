<?php
/**
 * Author: Chong Kah Yan
 */

namespace App\Factory;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
#[ORM\MappedSuperclass]
class UserType
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    protected $userId;

    #[ORM\Column(type: 'string', length: 100)]
    protected $userName;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    protected $phoneNo;

    #[ORM\Column(type: 'string', length: 255)]
    protected $password;

    // Getters and setters for the common properties

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId)
    {
        $this->userId= $userId;
        return $this;
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

    public function getPhoneNo(): ?string
    {
        return $this->phoneNo;
    }

    public function setPhoneNo(?string $phoneNo): self
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
}