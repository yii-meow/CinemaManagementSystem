<?php

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

    public function updateUser($userId, $data)
    {
        return $this->update(['userId' => $userId], $data);
    }
}