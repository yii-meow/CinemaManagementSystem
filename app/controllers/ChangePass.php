<?php

class ChangePass
{
    use Controller;

    public function index()
    {

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

        //Please do use this only at the end of the operations
        $this->view('Customer/User/ChangePass', $data);
    }
}