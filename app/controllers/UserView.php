<?php

namespace App\controllers;

use App\models\User;
use App\models\UserReward;
use App\models\Reward;
use App\core\Controller;
use App\core\Database;

class UserView
{
    use Controller;

    private $entityManager;
    private $userRepository;
    private $userRewardRepository;
    private $rewardRepository;

    public function __construct()
    {
        // Initialize EntityManager and repositories
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->userRewardRepository = $this->entityManager->getRepository(UserReward::class);
        $this->rewardRepository = $this->entityManager->getRepository(Reward::class);
    }

    public function index()
    {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Get userId from session or request
        $userId = $_GET['userId'] ?? $_SESSION['userId'] ?? null;

        if (!$userId) {
            // Redirect or handle error if userId is not available
            header('Location: UserManage');
            exit();
        }

        // Fetch user details
        $user = $this->userRepository->find($userId);

        // Fetch rewards associated with the user
        $userRewards = $this->userRewardRepository->findBy(['user' => $user]);

        $rewardDetails = [];
        foreach ($userRewards as $userReward) {
            $reward = $this->rewardRepository->find($userReward->getReward());
            if ($reward) {
                $rewardDetails[] = [
                    'rewardTitle' => $reward->getRewardTitle(),
                    'category' => $reward->getCategory(),
                    'rewardImg' => $reward->getRewardImg(),
                    'status' => $userReward->getStatus() // Assuming status is stored in UserReward
                ];
            }
        }

        // Prepare data for view
        $data = [
            'user' => $user,
            'rewards' => $rewardDetails
        ];

        // Render the UserView view with user and reward data
        $this->view('Admin/User/UserView', $data);
    }

    public function updateStatus()
    {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the request is a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get userId and status from POST data
            $userId = $_POST['userId'] ?? null;
            $status = $_POST['status'] ?? null;

            if ($userId && $status) {
                // Fetch user and update status
                $user = $this->userRepository->find($userId);
                if ($user) {
                    $user->setStatus($status);
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();

                    // Respond with success
                    echo json_encode(['success' => true, 'message' => 'Status updated successfully.']);
                } else {
                    // Respond with error
                    echo json_encode(['success' => false, 'message' => 'User not found.']);
                }
            } else {
                // Respond with error
                echo json_encode(['success' => false, 'message' => 'Invalid data.']);
            }
            exit();
        }
    }
}