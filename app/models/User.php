<?php
namespace App\models;

use Doctrine\ORM\Mapping as ORM;
class User
{

    protected $table = 'User';
    // Get user by phone number
    public function getUserByPhoneNo($phoneNo)
    {
        return $this->first(['phoneNo' => $phoneNo]);
    }

    // Method to insert a new user
    public function createUser($data)
    {
        return $this->insert($data);
    }

    // Get user by userId
    public function getUserById($userId)
    {
        return $this->first(['userId' => $userId]);
    }

    // Method to update user information in the User model
    public function updateUser($userId, $data)
    {
        return $this->update($userId, $data, 'userId'); // Specify the correct column name 'userId'
    }

}