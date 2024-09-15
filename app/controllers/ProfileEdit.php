<?php

namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;
use App\models\UserReward;

class ProfileEdit
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
            header('Location: ' . ROOT . '/Login');
            exit();
        }

        $userId = $_SESSION['userId'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle profile image upload
            $newProfileImg = $this->handleProfileImageUpload();

            // Fetch user from the repository
            $user = $this->userRepository->find($userId);

            if ($user) {
                // Update user data
                $user->setUserName($_POST['userName'])
                    ->setGender($_POST['gender'])
                    ->setPhoneNo($_POST['phoneNo'])
                    ->setEmail($_POST['email'])
                    ->setProfileImg($newProfileImg);


                // Save updated user data
                $this->entityManager->persist($user);
                $this->entityManager->flush();

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
                // Redirect to profile view with a success message or reload the profile edit view
                $this->view('Customer/User/ProfileEdit', $data);
                exit();
            } else {
                // Handle user not found error
                echo "User not found";
                exit();
            }
        } else {
            // If GET request, load current user data
            $user = $this->userRepository->find($userId);

            if (!$user) {
                // Handle user not found error
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

            $this->view('Customer/User/ProfileEdit', $data);
        }
    }

    private function handleProfileImageUpload(): string
    {
        $uploadDir = 'C:/xampp/htdocs/CinemaManagementSystem/public/assets/images/';
        $defaultImage = '.jpg';

        if (isset($_FILES['profileImg']) && $_FILES['profileImg']['error'] === UPLOAD_ERR_OK) {
            $uploadFile = $uploadDir . basename($_FILES['profileImg']['name']);
            if (move_uploaded_file($_FILES['profileImg']['tmp_name'], $uploadFile)) {
                return basename($_FILES['profileImg']['name']);
            } else {
                return $defaultImage;
            }
        }

        return $_POST['existingProfileImg'] ?? $defaultImage;
    }
}