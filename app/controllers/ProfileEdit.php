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
        $this->entityManager = Database::getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['userId'])) {
            header('Location: ' . ROOT . '/Login');
            exit();
        }

        $userId = $_SESSION['userId'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newProfileImg = $this->handleProfileImageUpload();
            $user = $this->userRepository->find($userId);

            if ($user) {
                $newPhoneNo = $_POST['phoneNo'];
                $existingUser = $this->userRepository->findOneBy(['phoneNo' => $newPhoneNo]);

                if ($existingUser && $existingUser->getUserId() !== $userId) {
                    $data = [
                        'error' => 'Phone number is already in use by another user.',
                        'user' => $this->prepareUserData($user)
                    ];
                    $this->view('Customer/User/ProfileEdit', $data);
                    exit();
                }

                $user->setUserName($_POST['userName'])
                    ->setGender($_POST['gender'])
                    ->setPhoneNo($newPhoneNo)
                    ->setEmail($_POST['email'])
                    ->setProfileImg($newProfileImg);

                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $data = [
                    'success' => 'Profile updated successfully.',
                    'user' => $this->prepareUserData($user)
                ];
                $this->view('Customer/User/ProfileEdit', $data);
                exit();
            } else {
                echo "User not found";
                exit();
            }
        } else {
            $user = $this->userRepository->find($userId);
            if (!$user) {
                echo "User not found";
                exit();
            }
            $data = [
                'user' => $this->prepareUserData($user)
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

    private function prepareUserData($user): array
    {
        return [
            'userId' => $user->getUserId(),
            'profileImg' => $user->getProfileImg(),
            'userName' => $user->getUserName(),
            'phoneNo' => $user->getPhoneNo(),
            'email' => $user->getEmail(),
            'gender' => $user->getGender(),
            'birthDate' => $user->getBirthDate(),
            'coins' => $user->getCoins()
        ];
    }
}