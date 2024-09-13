<?php

class Profile
{
    use Controller;

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

        // Fetch user details from the model
        $userModel = new User();
        $user = $userModel->getUserById($userId);

        if (!$user) {
            echo "User not found";
            exit();
        }

        // Pass the user data to the profile view
        $data['user'] = $user;
        $this->view('Customer/User/Profile', $data);
    }
}