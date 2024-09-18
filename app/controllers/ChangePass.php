<?php

namespace App\controllers;

use App\models\User;
use App\core\Controller;
use App\core\Database;

class ChangePass
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
            $_SESSION['error'] = 'User not found';
            header('Location: ' . ROOT . '/ChangePass');
            exit();
        }

        // Handle form submission for password change
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPass = $_POST['currentPass'];
            $newPass = $_POST['newPass'];
            $confirmPass = $_POST['confirmPass'];

            // Validate current password
            if (!password_verify($currentPass, $user->getPassword())) {
                $_SESSION['error'] = 'Current password is incorrect';
            } elseif ($newPass !== $confirmPass) {
                // Check if new passwords match
                $_SESSION['error'] = 'New passwords do not match';
            } else {
                // Update password
                $user->setPassword(password_hash($newPass, PASSWORD_BCRYPT));
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $_SESSION['success_message'] = 'Password successfully changed';
                header('Location: ' . ROOT . '/ChangePass');
                exit();
            }

            // Redirect back with error message
            header('Location: ' . ROOT . '/ChangePass');
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

        // Pass success and error messages to the view
        $data['success_message'] = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
        $data['error'] = isset($_SESSION['error']) ? $_SESSION['error'] : null;

        // Clear messages after displaying
        unset($_SESSION['success_message']);
        unset($_SESSION['error']);

        // Render the ChangePass view
        $this->view('Customer/User/ChangePass', $data);
    }
}