<?php

namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;
use App\models\UserReward;

class ChangePass
{
    use Controller;

    private $entityManager;
    private $userRepository;
    private $userRewardRepository;

    public function __construct()
    {
        // Initialize EntityManager and User repository
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->userRewardRepository = $this->entityManager->getRepository(UserReward::class);
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

        // Prepare user data for the view
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
        // Fetch user rewards from the repository
        $userRewards = $this->userRewardRepository->findBy(['userId' => $userId]);
        $data['rewardCount'] = count($userRewards);


        // Render the ChangePass view
        $this->view('Customer/User/ChangePass', $data);
    }

    public function updatePassword()
    {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if userId is set in the session
        if (!isset($_SESSION['userId'])) {
            header('Location: ' . ROOT . '/Login');
            exit();
        }

        // Get the userId from the session
        $userId = $_SESSION['userId'];

        // Fetch the user from the repository
        $user = $this->userRepository->find($userId);

        if (!$user) {
            echo "User not found";
            exit();
        }

        // Get the posted data
        $currentPass = $_POST['currentPass'];
        $newPass = $_POST['newPass'];
        $confirmPass = $_POST['confirmPass'];

        // Validate current password
        if (!password_verify($currentPass, $user->getPassword())) {
            echo "Current password is incorrect";
            exit();
        }

        // Validate new password and confirmation match
        if ($newPass !== $confirmPass) {
            echo "New passwords do not match";
            exit();
        }

        // Hash the new password
        $hashedNewPass = password_hash($newPass, PASSWORD_DEFAULT);

        // Update the user's password
        $user->setPassword($hashedNewPass);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Redirect to a success page or show success message
        echo "Password changed successfully";
        // Optionally redirect to the user profile
        // header('Location: ' . ROOT . '/User/Profile');
        exit();
    }
}