<?php

class User
{
    use Model;

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
}