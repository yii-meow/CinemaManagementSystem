<?php

namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;

class UserManage
{
    use Controller;

    private $entityManager;
    private $userRepository;

    public function __construct()
    {
        // Initialize EntityManager and User repository
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    public function index()
    {
        // Fetch all users from the database
        $users = $this->userRepository->findAll();

        // Pass the list of users to the view
        $data = [
            'users' => $users
        ];

        // Render the UserManage view with the user data
        $this->view('Admin/User/UserManage', $data);
    }
}