<?php

namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;

class Login
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
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data = ['error' => null];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phoneNo = $_POST['phoneNo'] ?? null;
            $password = $_POST['password'] ?? null;

            // Validate input
            if (empty($phoneNo) || empty($password)) {
                $data['error'] = "Please provide both phone number and password.";
            } else {
                // Fetch the user from the repository by phone number
                $user = $this->userRepository->findOneBy(['phoneNo' => $phoneNo]);

                // Check if user exists and password matches
                if ($user && password_verify($password, $user->getPassword())) {
                    $_SESSION['userId'] = $user->getUserId();
                    // Pass the user data to the profile view
                    $data['user'] = [
                        'userId' => $user->getUserId(),
                        'profileImg' => $user->getProfileImg(),
                        'userName' => $user->getUserName(),
                        'phoneNo' => $user->getPhoneNo(),
                        'email' => $user->getEmail(),
                        'gender' => $user->getGender(),
                        'birthDate' => $user->getBirthDate(),
                        'coins' => $user->getCoins()
                    ];
                    // Redirect to the profile page
                    $this->view('Customer/User/Profile', $data);
                    exit();
                } else {
                    $data['error'] = "Invalid phone number or password.";
                }
            }
        }

        // Render the login view
        $this->view('Customer/User/Login', $data);
    }
}