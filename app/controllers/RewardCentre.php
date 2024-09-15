<?php

namespace App\controllers;

use App\models\User;
use App\models\Reward;
use App\core\Controller;
use App\core\Database;
use App\models\UserReward;

class RewardCentre
{
    use Controller;

    private $entityManager;
    private $userRepository;
    private $rewardRepository;
    private $userRewardRepository;

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

        // Pass the rewards to the view
        $data['rewards'] = $rewards;

        // Render the RewardCentre view
        $this->view('Customer/User/RewardCentre', $data);
    }

    public function redeemReward($rewardId)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['userId'])) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            exit();
        }

        $userId = $_SESSION['userId'];

        // Fetch user and reward from the repositories
        $user = $this->userRepository->find($userId);
        $reward = $this->rewardRepository->find($rewardId);

        if (!$user || !$reward) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid user or reward']);
            exit();
        }

        // Check if the user has enough coins
        if ($user->getCoins() < $reward->getNeededCoins()) {
            echo json_encode(['status' => 'error', 'message' => 'Not enough coins']);
            exit();
        }

        // Check if the reward is available in stock
        if ($reward->getQty() <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Reward out of stock']);
            exit();
        }

        // Deduct the coins from the user
        $user->setCoins($user->getCoins() - $reward->getNeededCoins());

        // Update the reward quantity
        $reward->setQty($reward->getQty() - 1);

        // Create a new UserReward entry
        $userReward = new UserReward();
        $userReward->setUserId($userId);
        $userReward->setRewardId($rewardId);
        $userReward->setStatus('Unused');
        $userReward->setRedeemDate(new \DateTime());

        // Persist changes to the database
        $this->entityManager->persist($user);
        $this->entityManager->persist($reward);
        $this->entityManager->persist($userReward);
        $this->entityManager->flush();

        // Send success response
        echo json_encode(['status' => 'success', 'message' => 'Reward redeemed successfully']);
        exit();
    }
}