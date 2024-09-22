<?php
/**
 * Author: Chong Kah Yan
 */
namespace App\models;

use Doctrine\ORM\Mapping as ORM;
use App\Factory\UserType;

#[ORM\Entity]
#[ORM\Table(name: 'Admin')]
class Admin extends UserType
{
    #[ORM\Column(type: 'string', length: 50)]
    private $role;

    // Getters and Setters
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