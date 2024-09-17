<?php

namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;

class ProfileEdit
{
    use Controller;

    private $entityManager;
    private $userRepository;

    public function __construct()
    {
        // Initialize entityManager and repository
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
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
                $newPhoneNo = $_POST['phoneNo'];

                // Check if the phone number is already taken by another user
                $existingUser = $this->userRepository->findOneBy(['phoneNo' => $newPhoneNo]);

                if ($existingUser && $existingUser->getUserId() !== $userId) {
                    // Phone number is already in use by another user, show error
                    $data = [
                        'error' => 'Phone number is already in use by another user.',
                        'user' => [
                            'userId' => $user->getUserId(),
                            'profileImg' => $user->getProfileImg(),
                            'userName' => $user->getUserName(),
                            'phoneNo' => $user->getPhoneNo(),
                            'email' => $user->getEmail(),
                            'gender' => $user->getGender(),
                            'birthDate' => $user->getBirthDate(),
                            'coins' => $user->getCoins()
                        ]
                    ];

                    // Reload the profile edit view with the error message
                    $this->view('Customer/User/ProfileEdit', $data);
                    exit();
                }

                // Update user data if phone number is unique
                $user->setUserName($_POST['userName'])
                    ->setGender($_POST['gender'])
                    ->setPhoneNo($newPhoneNo)
                    ->setEmail($_POST['email'])
                    ->setProfileImg($newProfileImg);

                // Save updated user data
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                // Prepare data to pass to the view
                $data = [
                    'success' => 'Profile updated successfully.',
                    'user' => [
                        'userId' => $user->getUserId(),
                        'profileImg' => $user->getProfileImg(),
                        'userName' => $user->getUserName(),
                        'phoneNo' => $user->getPhoneNo(),
                        'email' => $user->getEmail(),
                        'gender' => $user->getGender(),
                        'birthDate' => $user->getBirthDate(),
                        'coins' => $user->getCoins()
                    ]
                ];

                // Redirect to profile view with a success message
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

            $data = [
                'user' => [
                    'userId' => $user->getUserId(),
                    'profileImg' => $user->getProfileImg(),
                    'userName' => $user->getUserName(),
                    'phoneNo' => $user->getPhoneNo(),
                    'email' => $user->getEmail(),
                    'gender' => $user->getGender(),
                    'birthDate' => $user->getBirthDate(),
                    'coins' => $user->getCoins()
                ]
            ];

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