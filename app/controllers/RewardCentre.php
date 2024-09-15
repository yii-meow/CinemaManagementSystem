<?php

namespace App\controllers;

use App\models\User;
use App\models\Reward;
use App\core\Controller;
use App\core\Database;

class RewardCentre
{
    use Controller;

    private $entityManager;
    private $userRepository;
    private $rewardRepository;

    public function __construct()
    {
        // Initialize EntityManager and repositories
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->rewardRepository = $this->entityManager->getRepository(Reward::class);
    }

    public function index()
    {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if userId is set in the session
        if (!isset($_SESSION['userId'])) {
            // Redirect to login if userId is not set
            header('Location: ' . ROOT . '/Login');
            exit();
        }

        $userId = $_SESSION['userId'];

        // Fetch user details from the repository
        $user = $this->userRepository->find($userId);

        if (!$user) {
            echo "User not found";
            exit();
        }

        // Fetch all rewards from the database
        $rewards = $this->rewardRepository->findAll();

        // Pass the user and rewards data to the view
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

        // Pass the rewards to the view
        $data['rewards'] = $rewards;

        // Render the RewardCentre view
        $this->view('Customer/User/RewardCentre', $data);
    }
}