<?php

namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;
use App\models\UserReward;

class Profile
{
    use Controller;

    private $entityManager;
    private $userRepository;
    private $userRewardRepository;

    public function __construct()
    {
        // Initialize entityManager and repository
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->userRewardRepository = $this->entityManager->getRepository(UserReward::class);
    }

    public function index()
    {
        // Start session if not started already
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if userId is set in the session
        if (!isset($_SESSION['userId'])) {
            // Redirect to login if userId is not set
            $this->view('Customer/User/Login');
            exit();
        }

        $userId = $_SESSION['userId'];

        // Fetch user details from the repository
        $user = $this->userRepository->find($userId);

        if (!$user) {
            echo "User not found";
            exit();
        }

        // Fetch user rewards from the repository
        $userRewards = $this->userRewardRepository->findBy(['userId' => $userId]);

        // Prepare data for the view
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
        $data['rewardCount'] = count($userRewards);

        $this->view('Customer/User/Profile', $data);
    }
}