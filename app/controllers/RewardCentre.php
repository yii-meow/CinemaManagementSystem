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

    public function redeemReward()
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
        $rewardId = $_POST['rewardId']; // Assuming rewardId is passed via POST

        // Fetch user and reward details
        $user = $this->userRepository->find($userId);
        $reward = $this->rewardRepository->find($rewardId);

        if (!$user || !$reward) {
            echo "User or reward not found";
            exit();
        }

        // Check if the user has enough coins
        if ($user->getCoins() < $reward->getNeededCoins()) {
            echo "Not enough coins to redeem this reward.";
            exit();
        }

        // Check if the reward quantity is available
        if ($reward->getQty() <= 0) {
            echo "Reward is out of stock.";
            exit();
        }

        // Proceed with redemption
        $userReward = new UserReward();
        $userReward->setUser($user);
        $userReward->setReward($reward);
        $userReward->setRewardCondition('unused'); // Updated method name

        // Generate a unique 6-digit promo code
        $promoCode = $this->generatePromoCode();
        $userReward->setPromoCode($promoCode);

        // Set the redeem date in yyyy-mm-dd format
        $redeemDate = new \DateTime();
        $formattedRedeemDate = $redeemDate->format('Y-m-d'); // Format date to yyyy-mm-dd
        $userReward->setRedeemDate($formattedRedeemDate);

        // Persist the new user reward
        $this->entityManager->persist($userReward);

        // Update the reward quantity
        $reward->setQty($reward->getQty() - 1);
        $this->entityManager->flush();

        // Update user's coins
        $user->setCoins($user->getCoins() - $reward->getNeededCoins());
        $this->entityManager->flush();

        echo "Reward redeemed successfully. Your promo code is: " . $promoCode;
    }

    private function generatePromoCode(): int
    {
        $promoCode = rand(100000, 999999);

        // Check for uniqueness
        while ($this->isPromoCodeExists($promoCode)) {
            $promoCode = rand(100000, 999999);
        }

        return $promoCode;
    }

    private function isPromoCodeExists($promoCode): bool
    {
        // Query the database to check if the promo code already exists
        $promoRepository = $this->entityManager->getRepository(UserReward::class);
        return $promoRepository->findOneBy(['promoCode' => $promoCode]) !== null;
    }


}